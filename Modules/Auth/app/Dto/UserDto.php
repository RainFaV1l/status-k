<?php

namespace Modules\Auth\Dto;

class UserDto
{
    public int $id;
    public string $full_name;
    public string $email;
    public string $role;

    public function __construct(int $id, string $full_name, string $email, string $role)
    {
        $this->id = $id;
        $this->full_name = $full_name;
        $this->email = $email;
        $this->role = $role;
    }
}
