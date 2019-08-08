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
        $validatedData = $request->validated();
        $client->name = $validatedData['name'];
        $client->description = $validatedData['description'];
        $client->contact_name = $validatedData['contact_name'];
        $client->contact_phone = $validatedData['contact_phone'];
        $client->contact_email = $validatedData['contact_email'];
        
        // using save so we can have observer on updates, observer would then use pusher to update other users
        $client->save();
    }
}