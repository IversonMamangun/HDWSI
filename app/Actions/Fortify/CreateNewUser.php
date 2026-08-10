<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Enums\RoleEnum;
use App\Events\GuardianConsentRequested;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {
            $user = User::create([
                'first_name' => $input['first_name'],
                'middle_name' => $input['middle_name'] ?? null,
                'last_name' => $input['last_name'],
                'email' => $input['email'] ?? null,
                'phone_number' => $input['phone_number'] ?? null,
                'date_of_birth' => $input['date_of_birth'],
                'address' => $input['address'],
                'id_type' => $input['id_type'] ?? null,
                'id_number' => $input['id_number'] ?? null,
                'password' => $input['password'],
            ]);

            $user->assignRole(RoleEnum::APPLICANT->value);

            if (!empty($input['id_document'])) {
                $user->addMedia($input['id_document'])
                    ->toMediaCollection('government_id');
            }

            if (User::isMinorForDateOfBirth($input['date_of_birth'])) {
                $guardian = User::firstOrCreate(
                    ['email' => $input['guardian_email']],
                    [
                        'first_name' => $input['guardian_first_name'],
                        'last_name' => $input['guardian_last_name'],
                        'password' => str()->random(32),
                        'address' => $input['address'],
                    ]
                );

                $isNewGuardian = $guardian->wasRecentlyCreated;

                $guardian->assignRole(RoleEnum::GUARDIAN->value);

                $guardian->linkedApplicants()->syncWithoutDetaching([
                    $user->id => ['relationship' => $input['guardian_relationship']],
                ]);

                event(new GuardianConsentRequested($user, $guardian, $isNewGuardian));
            }

            return $user;
        });
    }
}
