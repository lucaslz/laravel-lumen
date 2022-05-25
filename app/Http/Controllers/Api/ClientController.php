<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ClientService;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class ClientController extends Controller
{
    private $clientService;

    public function __construct()
    {
        $this->clientService = new ClientService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientResource = $this->clientService->listAllUsers();
        $status = $clientResource->isEmpty() ? ResponseStatus::HTTP_NO_CONTENT : ResponseStatus::HTTP_OK;
        return  $clientResource->response()->setStatusCode($status);
    }
}
