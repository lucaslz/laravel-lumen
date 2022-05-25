<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Core\BaseEloquentRepository;
use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository extends BaseEloquentRepository implements ClientRepositoryInterface
{
    public function entity()
    {
        return Client::class;
    }
}