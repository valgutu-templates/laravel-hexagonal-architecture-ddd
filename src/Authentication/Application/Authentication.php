<?php

namespace App\ApplicationName\Authentication\Application;

use App\ApplicationName\Authentication\Domain\DTO\AuthenticationRequest;
use App\ApplicationName\Authentication\Domain\DTO\AuthenticationResponse;
use Illuminate\Support\Facades\Auth;

class Authentication
{
    public function __construct()
    {
    }

    public function auth(AuthenticationRequest $requests): AuthenticationResponse
    {
        return new AuthenticationResponse(200, []);
    }

    private function authByEmail(string $email, string $password): AuthenticationResponse
    {
        return new AuthenticationResponse(200, []);
    }

    private function authByPhone(string $phone, string $password): AuthenticationResponse
    {
        return new AuthenticationResponse(200, []);
    }
}
