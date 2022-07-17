<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrator\CreateAdminRequest;
use App\Traits\QuickResponseTrait;
use App\Models\Administrator;
use App\Traits\Tokenizer;
use Illuminate\Http\Request;
use App\Traits\Administrator\AdministratorQuery;

class AdminAuthController extends Controller
{
    use QuickResponseTrait, Tokenizer, AdministratorQuery;

    /**
     * Admin Login
     *
     * @return json
     */
    public function login(Request $request) {
        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return $this->makeJsonResponse(['error' => 'Invalid Login Credentials'], 401);
        }

        return $this->makeJsonResponse([
            'token' => $this->generateToken($this->getloggedInAdmin()),
            'data' => $this->getloggedInAdmin(),
            'message' => 'Login Successful'
        ], 201);
    }

    /**
     * @return json
     */
    public function register(CreateAdminRequest $request) {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        $admin = Administrator::create($validated);

        return $this->makeJsonResponse([
            'data' => $admin,
            'message' => 'Account Created successfully',
        ], 201);
    }

    /**
     * @param Request $request
     * @return json
     */
    public function updateAdminRecord(Request $request, Administrator $admin) {
        return response()->json($request);
        $administrator = $this->getLoggedInAdmin()->update($request->validated());
        return $this->makeJsonResponse([
            'data' => $administrator,
            'message' => 'Account Updated successfully',
        ], 201);
    }

    public function deleteAdminProfile(Administrator $administrator) {
        // return response()->json($administrator);
        $administrator->delete();
        return $this->makeJsonResponse([
            'message' => 'Account Deleted successfully',
        ], 201);
    }
}
