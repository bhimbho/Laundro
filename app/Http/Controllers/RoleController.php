<?php

namespace App\Http\Controllers;

use App\Http\Enum\RoleEnum;

class RoleController extends Controller
{

    public function index() {
        return response()->json([
            'data' => RoleEnum::cases(),
        ], 200);
    }
}
