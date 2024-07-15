<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $availableTimes = json_decode($this->available_times, true);

        // Initialize an empty array for formatted available times
        $formattedAvailableTimes = [];

        // Ensure availableTimes is an array
        if (is_array($availableTimes)) {
            $type = $availableTimes['type'];
            if (isset($type)) {
                if ($type === "Normal Day") {
                    $formattedAvailableTimes[] = [
                        'type' => $type,
                        'morning' => [
                            'start' => $availableTimes['morning']['start'] ?? null,
                            'end' => $availableTimes['morning']['end'] ?? null,
                        ],
                        'afternoon' => [
                            'start' => $availableTimes['afternoon']['start'] ?? null,
                            'end' => $availableTimes['afternoon']['end'] ?? null,
                        ],
                    ];
                } else {
                    $formattedAvailableTimes[] = [
                        'type' => $type,
                        'start' => $availableTimes['start'] ?? null,
                        'end' => $availableTimes['end'] ?? null,
                    ];
                }
            }
        }

        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'childCategoryId' => $this->child_category_id,
            'pricingModel' => str_replace('_', ' ', $this->pricing_model),
            'price' => $this->price,
            'location' => $this->location,
            'availableTimes' => $formattedAvailableTimes,
        ];
    }
}
