<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\ValidationRule;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array<int, Password|ValidationRule|array<mixed>|string>
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }

    /**
     * Get the validation rules used to validate an optional password change.
     *
     * Used on update forms, where leaving the field blank means "keep the
     * current password" rather than being an error. 'nullable' short-circuits
     * the remaining rules (including 'confirmed') when the value is empty,
     * so the confirmation field is only checked when a new password is
     * actually being set.
     *
     * @return array<int, Password|ValidationRule|array<mixed>|string>
     */
    protected function optionalPasswordRules(): array
    {
        return ['nullable', 'string', Password::default(), 'confirmed'];
    }

    /**
     * Get the validation rules used to validate the current password.
     *
     * @return array<int, Password|ValidationRule|array<mixed>|string>
     */
    protected function currentPasswordRules(): array
    {
        return ['required', 'string', 'current_password'];
    }
}
