<?php

namespace App\ApplicationName\DataStore\Role\Domain\DTO;

class RoleResponse implements \JsonSerializable
{
    private ?int $id;
    private ?string $title;
    private ?string $slug;
    private bool $default;

    public function __construct(array $row)
    {
        $this->id = $row['id'] ?? null;
        $this->title = $row['title'] ?? null;
        $this->slug = $row['slug'] ?? null;
        $this->default = $row['default'] ?? 0;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function title(): ?string
    {
        return $this->title;
    }

    public function slug(): ?string
    {
        return $this->slug;
    }

    public function default(): ?string
    {
        return $this->default;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'default' => $this->default,
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
