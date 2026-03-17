<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function __construct(private readonly User $user = new User())
    {
    }

    public function currentUserRole(): string
    {
        return 'guest';
    }
}
