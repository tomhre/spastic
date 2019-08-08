<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients\Client;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;


class ClientController extends Controller
{

    public function index()
    {
        return Client::all();
    }
    
    public function store(CreateClientRequest $request)
    {
        return Client::create($request->validated());
    }
    
    public function update(UpdateClientRequest $request, Client $client)
    {
        dd($client);
    }
}