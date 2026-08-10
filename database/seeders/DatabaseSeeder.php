<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);

        foreach (RoleEnum::cases() as $role) {
            match ($role) {
                RoleEnum::APPLICANT => $this->seedApplicants(),
                RoleEnum::GUARDIAN => null, // created alongside minor applicants, not standalone
                default => $this->seedStaffOrMember($role),
            };
        }
    }

    /**
     * Create a single staff/member/adult-applicant-style test user for a given role.
     */
    private function seedStaffOrMember(RoleEnum $role): void
    {
        $user = User::factory()->create([
            'first_name' => str($role->value)
                ->replace('-', ' ')
                ->title()
                ->explode(' ')
                ->first(),
            'last_name' => 'User',
            'email' => strtolower(str($role->value)->replace('-', '.')) . '@example.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole($role);
    }

    /**
     * Applicants need special handling: one adult applicant (no guardian needed)
     * and one minor applicant (auto-creates + links a guardian, mirroring what
     * CreateNewUser does on real registration).
     */
    private function seedApplicants(): void
    {
        $adultApplicant = User::factory()->create([
            'first_name' => 'Adult',
            'last_name' => 'Applicant',
            'email' => 'applicant.adult@example.com',
            'password' => Hash::make('password'),
            'date_of_birth' => now()->subYears(20)->format('Y-m-d'),
        ]);
        $adultApplicant->assignRole(RoleEnum::APPLICANT);

        $minorApplicant = User::factory()->minor()->create([
            'first_name' => 'Minor',
            'last_name' => 'Applicant',
            'email' => 'applicant.minor@example.com',
            'password' => Hash::make('password'),
        ]);
        $minorApplicant->assignRole(RoleEnum::APPLICANT);

        $guardian = User::factory()->create([
            'first_name' => 'Guardian',
            'last_name' => 'User',
            'email' => 'guardian@example.com',
            'password' => Hash::make('password'),
            'date_of_birth' => now()->subYears(45)->format('Y-m-d'),
        ]);
        $guardian->assignRole(RoleEnum::GUARDIAN);

        $guardian->linkedApplicants()->attach($minorApplicant->id, [
            'relationship' => 'Parent',
            'consent_given_at' => now(), // pre-consented for local dev convenience
        ]);
    }
}
