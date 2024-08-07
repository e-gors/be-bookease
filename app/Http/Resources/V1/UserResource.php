<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\V1\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'isVerified' => $this->email_verified_at !== null,
            'status' => $this->status,
            'bannedUntil' => $this->banned_until,
            'profile' => new ProfileResource($this->whenLoaded('profile')),
            'services' => ServiceResource::collection($this->whenLoaded('services')),
        ];
    }
}
