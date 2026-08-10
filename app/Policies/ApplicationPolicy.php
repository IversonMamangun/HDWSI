<?php

namespace App\Policies;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\User;

class ApplicationPolicy
{
    public function viewOwn(User $user): bool
    {
        return $user->hasRole(RoleEnum::APPLICANT->value)
            && $user->hasPermissionTo(PermissionEnum::APPLICATIONS_VIEW_OWN->value);
    }

    public function submit(User $user): bool
    {
        if (!$user->hasRole(RoleEnum::APPLICANT->value)) {
            return false;
        }

        if (!$user->hasPermissionTo(PermissionEnum::APPLICATIONS_SUBMIT->value)) {
            return false;
        }

        if ($user->is_minor) {
            return $user->hasGuardianConsent();
        }

        return true;
    }

    public function uploadDocuments(User $user): bool
    {
        return $this->submit($user);
    }

    public function viewChildApplication(User $guardian, User $applicant): bool
    {
        return $guardian->hasRole(RoleEnum::GUARDIAN->value)
            && $guardian->hasPermissionTo(PermissionEnum::GUARDIAN_VIEW_CHILD_APPLICATION->value)
            && $guardian->linkedApplicants()->where('applicant_id', $applicant->id)->exists();
    }

    public function giveConsent(User $guardian, User $applicant): bool
    {
        return $guardian->hasRole(RoleEnum::GUARDIAN->value)
            && $guardian->hasPermissionTo(PermissionEnum::GUARDIAN_CONSENT->value)
            && $guardian->linkedApplicants()->where('applicant_id', $applicant->id)->exists();
    }
}
