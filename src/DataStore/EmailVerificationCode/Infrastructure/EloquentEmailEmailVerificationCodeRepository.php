<?php

namespace App\ApplicationName\DataStore\EmailVerificationCode\Infrastructure;

use App\ApplicationName\DataStore\EmailVerificationCode\Domain\Models\EmailVerificationCode;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\EmailVerificationCodeRepository;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeRequest;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\DTO\EmailVerificationCodeResponse;
use App\ApplicationName\DataStore\EmailVerificationCode\Domain\Exceptions\EmailVerificationCodeNotFoundException;

class EloquentEmailEmailVerificationCodeRepository implements EmailVerificationCodeRepository
{
    public function create(EmailVerificationCodeRequest $request): EmailVerificationCodeResponse
    {
        $row = EmailVerificationCode::create($request->toArray());
        $row->save();

        return new EmailVerificationCodeResponse($row->toArray());
    }

    public function find(EmailVerificationCodeRequest $request): EmailVerificationCodeResponse
    {
        $query = EmailVerificationCode::query()->orderByDesc('id');

        if ($request->code()) {
            $query->where('code' , $request->code());
        }
        if ($request->userId()) {
            $query->where('user_id' , $request->userId());
        }

        $row = $query->first();
        if (!$row) {
            throw new EmailVerificationCodeNotFoundException();
        }

        return new EmailVerificationCodeResponse($row->toArray());
    }

    public function delete(int $id): bool
    {
        return EmailVerificationCode::where('id', $id)->delete();
    }
}
