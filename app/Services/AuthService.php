<?php

namespace App\Services;

use App\Models\User;
use Throwable;

class AuthService
{
    public function __construct(private readonly User $user = new User())
    {
    }

    public function currentUserRole(): string
    {
        return 'guest';
    }

    public function register(array $payload): int
    {
        $name = trim((string) ($payload['name'] ?? ''));
        $email = strtolower(trim((string) ($payload['email'] ?? '')));
        $password = (string) ($payload['password'] ?? '');

        if ($name === '' || $email === '' || strlen($password) < 6) {
            return 0;
        }

        try {
            $exists = $this->user->findByEmail($email);
            if ($exists !== null) {
                return 0;
            }

            return $this->user->create([
                'name' => $name,
                'email' => $email,
                'password_hash' => password_hash($password, PASSWORD_BCRYPT),
                'role_id' => 2,
                'status' => 'active',
            ]);
        } catch (Throwable) {
            return 0;
        }
    }
}
