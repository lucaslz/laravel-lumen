<?php

namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use App\Http\Resources\Collection\ClientCollection;

class ClientService
{
    private $clientRepository;

    public function __construct()
    {
        $this->clientRepository = repository_injection(ClientRepositoryInterface::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return UserCollection
     */
    public function listAllUsers()
    {
        $users = $this->clientRepository->paginate();
        return new ClientCollection($users);
    }
}