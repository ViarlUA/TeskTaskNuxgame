<?php

namespace App\Dto\Auth;

readonly class RegisterDto
{
    public function __construct(
        public string $username,
        public string $phone
    )
    {
    }
}