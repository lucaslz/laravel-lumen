<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseEloquentRepository implements UserRepositoryInterface
{
    public function entity()
    {
        return User::class;
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['verification_token'] = md5(Str::random(60));
        return $this->entity->create($data);
    }
}