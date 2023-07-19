<?php

namespace App\ApplicationName\DataStore\AccessToken\Infrastructure;

use App\ApplicationName\DataStore\AccessToken\Domain\AccessTokenRepository;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenRequest;
use App\ApplicationName\DataStore\AccessToken\Domain\DTO\AccessTokenResponse;
use App\ApplicationName\DataStore\AccessToken\Domain\Exceptions\AccessTokenNotFoundException;
use App\ApplicationName\DataStore\AccessToken\Domain\Models\AccessToken;

class EloquentAccessTokenRepository implements AccessTokenRepository
{
    public function create(AccessTokenRequest $request): AccessTokenResponse
    {
        $row = AccessToken::create($request->toArray());
        $row->save();

        return new AccessTokenResponse($row->toArray());
    }

    public function findByUser(AccessTokenRequest $request): AccessTokenResponse
    {
        $row = AccessToken::query()
            ->where('user_id', $request->userId())
            ->where('access_token', $request->accessToken())
            ->first();

        if (!$row) {
            throw new AccessTokenNotFoundException($request->accessToken());
        }

        return new AccessTokenResponse($row->toArray());
    }

    public function deleteByUser(int $userId): bool
    {
        return AccessToken::where('user_id', $userId)->delete();
    }
}
