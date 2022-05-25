<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;
use App\Services\UserService;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userResource = $this->userService->listAllUsers();
        $status = $userResource->isEmpty() ? ResponseStatus::HTTP_NO_CONTENT : ResponseStatus::HTTP_OK;
        return  $userResource->response()->setStatusCode($status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {
        return $this->userService->createNewUser($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return $this->userService->getUser($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, int $id)
    {     
        $result = $this->userService->updateUser($request->validated(), $id);
        $status = $result ? ResponseStatus::HTTP_ACCEPTED : ResponseStatus::HTTP_NOT_MODIFIED;
        return  response('', $status);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $result = $this->userService->deleteUser($id);
        $status = $result ? ResponseStatus::HTTP_ACCEPTED : ResponseStatus::HTTP_NOT_MODIFIED;

        return  response('', $status);
    }

    // /**
    //  * Verify if token is valid.
    //  *
    //  * @param string $token
    //  * @return \Illuminate\Http\Response
    //  */
    // public function verify(string $token)
    // {
    //     $result = $this->userService->veirfyUserToken($token);

    //     if (!$result) {
    //         return response()->json(['message' => 'Token invalido'], ResponseStatus::HTTP_NOT_MODIFIED);
    //     }
    
    //     $redirect = request()->get('redirect');
    //     return redirect()->to($redirect);
    // }

    // /**
    //  * Get tokem by e-mail and passsward with verification password.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function login(Request $request)
    // {
    //     $this->validate($request, $this->validateLogin());
    //     $result = $this->userService->userLogin($request->all());

    //     if (!$result) {
    //         return response()->json(['message' => 'E-mail ou senha invalidos'], ResponseStatus::HTTP_UNAUTHORIZED);
    //     }

    //     return response()->json($result, ResponseStatus::HTTP_OK);
    // }

    // /**
    //  * Get tokem by e-mail and passsward with verification password.
    //  *
    //  * @param \Illuminate\Http\Request $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function refresh(Request $request)
    // {
    //     $result = $this->userService->refreshTokenUserLogin($request->user());

    //     if (!$result) {
    //         return response()->json(['message' => 'Token invalido'], ResponseStatus::HTTP_UNAUTHORIZED);
    //     }

    //     return response()->json($result, ResponseStatus::HTTP_OK);
    // }
}