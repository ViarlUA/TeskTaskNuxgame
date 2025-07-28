<?php

namespace App\Service\AccessToken;

use App\Models\AccessToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class AccessTokenService
{
    public function generateToken(User $user): AccessToken
    {
        $token = Str::random(64);
        
        $expiresAt = Carbon::now()
            ->addDays(7);
        
        return $user->accessTokens()
            ->create([
                'token'      => $token,
                'expires_at' => $expiresAt,
            ]);
    }
    
    public function getToken(string $token): ?AccessToken
    {
        return AccessToken::where('token', $token)
            ->where('expires_at', '>', Carbon::now())
            ->whereNull('deactivated_at')
            ->first();
    }
    
    
    public function deactivateToken(AccessToken $token): void
    {
        $token->update([
            'deactivated_at' => Carbon::now(),
        ]);
    }
}