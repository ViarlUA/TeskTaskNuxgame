<?php

namespace App\Service\Auth;

use App\Dto\Auth\RegisterDto;
use App\Models\AccessToken;
use App\Models\User;
use App\Service\AccessToken\AccessTokenService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

readonly class AuthService
{
    public function __construct(private AccessTokenService $tokenService)
    {
    }
    
    public function register(RegisterDto $dto): AccessToken
    {
        $user = User::where('phone', $dto->phone)->first();
        
        if ($user) {
            if ($user->username !== $dto->username) {
                throw ValidationException::withMessages([
                    'username' => 'The username does not match the registered phone number.',
                ]);
            }
        } else {
            $user = User::create([
                'username' => $dto->username,
                'phone'    => $dto->phone,
            ]);
        }
        
        return $this->tokenService->generateToken($user);
    }
}