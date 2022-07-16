<?php

namespace App\Traits;

trait Tokenizer {
    public function generateToken($user) {
        $token = $user->createToken('Laundro App Token')->plainTextToken;
        return $token;
    }
}