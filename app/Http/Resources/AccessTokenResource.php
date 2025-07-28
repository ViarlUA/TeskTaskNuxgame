<?php

namespace App\Http\Resources;

use App\Models\AccessToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AccessToken */
class AccessTokenResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'token'          => $this->token,
            'url'            => route('tokens.view', ['token' => $this->token]),
            'is_active'      => $this->isValid(),
            
            'expires_at'     => $this->expires_at,
            'deactivated_at' => $this->deactivated_at,
            
            'updated_at'     => $this->updated_at,
            'created_at'     => $this->created_at,
            
            
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
