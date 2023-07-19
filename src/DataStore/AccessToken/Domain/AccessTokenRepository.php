<?php

namespace App\ApplicationName\DataStore\AccessToken\Domain;

use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenRequest;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenResponse;

interface AccessTokenRepository
{
    public function create(AccessTokenRequest $request): AccessTokenResponse;

    public function findByUser(AccessTokenRequest $request): AccessTokenResponse;

    public function deleteByUser(int $userId): bool;
}
