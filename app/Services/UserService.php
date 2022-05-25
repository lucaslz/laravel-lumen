<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Http\Resources\Collection\UserCollection;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = repository_injection(UserRepositoryInterface::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function listAllUsers()
    {
        $users = $this->userRepository->paginate();
        return new UserCollection($users);
    }

    /**
     * Create New User
     *
     * @param array $data
     * @return UserResource
     */
    public function createNewUser(array $data)
    {
        $user = $this->userRepository->create($data);

        $user->verification_token = md5(Str::random(40));
        $user->save();

        $redirect = route('verification_account', [
            'token' => $user->verification_token,
            'redirect' => request('redirect')
        ]);

        $redirect = check_correct_url($redirect);
        $userResource = new UserResource($user);

        // Notification::send($user, new AccountCreated($user, $redirect));

        return $userResource;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource
     */
    public function getUser(int $id)
    {
        $user = $this->userRepository->findById($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function updateUser(array $data, int $id)
    {
        $user = $this->userRepository->findById($id);
        if(!empty($user)) return $this->userRepository->update($data, $id);

        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return UserResource
     */
    public function deleteUser(int $id)
    {
        $user = $this->userRepository->findById($id);
        if(!empty($user)) return $user->delete();

        return false;
    }

    public function veirfyUserToken(string $token)
    {
        $user = $this->userRepository->findByWhereFirst(['verification_token' => $token]);
        if (!$user) return false;

        $user->verification_token = null;
        $user->verified = true;
        return $user->save();
    }

    public function userLogin(array $data)
    {
        $user = $this->userRepository->findByWhereFirst(['email' => $data['email']]);
 
        if (!$user) return false;

        if (Hash::check($data['password'], $user->password)) {

            $expiration = new Carbon();
            $user->api_token = sha1(Str::random(32)) . '.' . sha1(Str::random(32));
            $user->api_token_expires_at = $expiration->addHour(2);
            $user->save();

            return [
                'api_token' => $user->api_token,
                'api_token_expires_at' => $user->api_token_expires_at
            ];
        }

        return false;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @return bool
     */
    public function refreshTokenUserLogin(User $user)
    {
        $expiration = new Carbon();
        $user->api_token = sha1(Str::random(32)) . '.' . sha1(Str::random(32));
        $user->api_token_expires_at = $expiration->addHour(2);
        $result = $user->save();

        if($result) return [
            'api_token' => $user->api_token,
            'api_token_expires_at' => $user->api_token_expires_at
        ];

        return false;
    }
}