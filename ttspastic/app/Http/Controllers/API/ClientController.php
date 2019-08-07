<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clients\Client;

class ClientController extends Controller
{

    public function index()
    {
        return Client::all();
    }
    
    public function store(Request $request)
    {
        return Client::create($request->validated());
    }
}