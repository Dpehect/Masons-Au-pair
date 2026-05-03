<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuPairResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'age' => now()->diffInYears($this->birth_date),
            'nationality' => $this->nationality,
            'languages' => $this->languages,
            'bio' => $this->bio,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'links' => [
                'self' => route('aupairs.show', $this->id),
            ]
        ];
    }
}
