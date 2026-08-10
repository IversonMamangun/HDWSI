<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,

            'full_name' => collect([
                $this->first_name,
                $this->middle_name,
                $this->last_name,
            ])->filter()->implode(' '),

            'initials' => collect([
                $this->first_name,
                $this->last_name,
            ])
                ->filter()
                ->map(fn(string $name) => strtoupper(substr($name, 0, 1)))
                ->implode(''),

            'email' => $this->email,
            'email_verified' => $this->hasVerifiedEmail(),
            'email_verified_at' => $this->email_verified_at?->toDateTimeString(),

            'phone_number' => $this->phone_number,
            'phone_number_verified_at' => $this->phone_number_verified_at?->toDateTimeString(),

            'date_of_birth' => $this->date_of_birth?->toDateString(),
            'address' => $this->address,

            'id_type' => $this->id_type,
            'id_number' => $this->id_number,

            'roles' => $this->roles
                ->pluck('name')
                ->values(),

            'primary_role' => $this->roles
                ->first()?->name,

            'created_at' => $this->created_at?->format('M d, Y'),
            'updated_at' => $this->updated_at?->format('M d, Y'),

            'can' => [
                'view' => $request->user()?->can('view', $this->resource),
                'update' => $request->user()?->can('update', $this->resource),
                'delete' => $request->user()?->can('delete', $this->resource),
            ],
        ];
    }
}
