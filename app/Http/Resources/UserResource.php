<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'created_at'          => $this->created_at,
            'username'            => $this->username,
            'updated_at'          => $this->updated_at,
            'notifications_count' => $this->notifications_count,
            'id'                  => $this->id,
            'phone'               => $this->phone,
        ];
    }
}
