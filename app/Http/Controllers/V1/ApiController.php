<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    protected array $publicMethods = ['index', 'show'];

    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => $this->publicMethods]);
    }
}
