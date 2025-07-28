<?php

namespace App\Http\Resources;

use App\Models\GameHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin GameHistory */
class GameHistoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'is_win'     => $this->is_win,
            'winnings'   => number_format($this->winnings, 2, '.', ''),
            'created_at' => $this->created_at,
        ];
    }
}
