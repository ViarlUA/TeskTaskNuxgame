<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperGameHistory
 */
class GameHistory extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
