<?php

namespace App\Http\Resources\V1;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'gender' => $this->gender,
            'address' => trim($this->street . " " . $this->barangay),
            'locality' => $this->locality,
            'province' => $this->state,
            'country' => $this->country,
            'postalCode' => $this->postal_code,
            'profilePicture' => $this->profile_picture,
        ];
    }
}
