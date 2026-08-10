<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Gate;

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
            'is_minor' => $this->is_minor,
            'address' => $this->address,

            'id_type' => $this->id_type,
            'id_number' => $this->when(
                Gate::allows('viewIdDocument', $this->resource),
                $this->id_number,
            ),

            'approved_at' => $this->approved_at?->format('M j, Y'),
            'rejected_at' => $this->rejected_at?->format('M j, Y'),
            'rejection_reason' => $this->rejection_reason,
            'guardians' => GuardianResource::collection($this->whenLoaded('guardians')),

            'roles' => $this->roles
                ->pluck('name')
                ->values(),

            'primary_role' => $this->roles
                ->first()?->name,

            'created_at' => $this->created_at?->format('M d, Y'),
            'updated_at' => $this->updated_at?->format('M d, Y'),

            'can' => [
                'view' => Gate::allows('viewIdDocument', $this->resource),
                'approve' => Gate::allows('approveApplicant', $this->resource),
                'reject' => Gate::allows('rejectApplicant', $this->resource),
            ],
        ];
    }
}
