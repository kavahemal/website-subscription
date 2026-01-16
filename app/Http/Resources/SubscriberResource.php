<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'subscription_count' => $this->whenCounted('subscriptions'),
            'websites' => $this->whenLoaded('subscriptions', function () {
                return $this->subscriptions->map(function ($subscription) {
                    return [
                        'id' => $subscription->website_id,
                        'name' => $subscription->website->name
                    ];
                });
                return $this->subscriptions->map->only(['website_id', 'website']);
            }),
        ];
    }
}
