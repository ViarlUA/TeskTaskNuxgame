<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperAccessToken
 */
class AccessToken extends Model
{
    protected $fillable = [
        'token',
        'expires_at',
        'deactivated_at',
    ];
    
    protected $casts = [
        'expires_at' => 'datetime',
        'deactivated_at' => 'datetime',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function isValid(): bool
    {
        return !$this->deactivated_at && $this->expires_at > now();
    }
}
