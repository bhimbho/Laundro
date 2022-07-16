<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\CreateAdminRequest;
use App\Traits\QuickResponseTrait;
use App\Models\Administrator;
use App\Traits\Tokenizer;

class AdminAuthController extends Controller
{
    use QuickResponseTrait, Tokenizer;

    public function login() {
        $admin = Administrator::firstOrFail();
        return $this->makeJsonResponse([
            'token' => $this->generateToken($admin),
            'admin' => $admin,
        ], 201);
    }

    /**
     * @return json
     */
    public function register(CreateAdminRequest $request) {
        $validated = $request->validated();
        $admin = Administrator::create($validated);

        return $this->makeJsonResponse([
            'token' => $this->generateToken($admin),
            'admin' => $admin,
        ], 201);
    }

    public function read() {
        $admin = Administrator::firstOrFail();
        return $this->makeJsonResponse([
            'admin' => $admin,
        ], 200);
    }
}
