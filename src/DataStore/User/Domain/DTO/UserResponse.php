<?php

namespace App\ApplicationName\DataStore\User\Domain\DTO;

class UserResponse implements \JsonSerializable
{
    private ?int $id;
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $phone;
    private ?string $password;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(array $row)
    {
        $this->id = $row['id'] ?? null;
        $this->firstName = $row['first_name'] ?? null;
        $this->lastName = $row['last_name'] ?? null;
        $this->email = $row['email'] ?? null;
        $this->phone = $row['phone'] ?? null;
        $this->password = $row['password'] ?? null;
        $this->createdAt = $row['created_at'] ?? null;
        $this->updatedAt = $row['updated_at'] ?? null;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function firstName(): ?string
    {
        return $this->firstName;
    }

    public function lastName(): ?string
    {
        return $this->lastName;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function phone(): ?string
    {
        return $this->phone;
    }

    public function password(): ?string
    {
        return $this->password();
    }

    public function createdAt(): ?string
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function toArray(bool $withPassword = false): array
    {
        $data = [
            'id' => $this->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
        if ($withPassword) {
            $data['password'] = $this->password;
        }
        return $data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
