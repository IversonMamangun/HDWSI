<?php

namespace App\Concerns;

use App\Enums\IdType;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Rule;

trait ProfileValidationRules
{
    /**
     * Get the validation rules used to validate user profiles.
     *
     * @return array<string, array<int, ValidationRule|array<mixed>|string>>
     */
    protected function profileRules(?int $userId = null, bool $isPrecognitive = false): array
    {
        return [
            'first_name' => $this->firstNameRules(),
            'middle_name' => $this->middleNameRules(),
            'last_name' => $this->lastNameRules(),
            'email' => $this->emailRules($userId, $isPrecognitive),
            'phone_number' => $this->phoneNumberRules(),
            'date_of_birth' => $this->dateOfBirthRules(),
            'address' => $this->addressRules(),
            'id_type' => $this->idTypeRules(),
            'id_number' => $this->idNumberRules(),
        ];
    }

    /**
     * Get the validation rules used to validate first names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function firstNameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rules used to validate middle names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function middleNameRules(): array
    {
        return ['nullable', 'string', 'max:255'];
    }

    /**
     * Get the validation rules used to validate last names.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function lastNameRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rules used to validate user emails.
     *
     * @param  bool  $isPrecognitive  When true, skips the database uniqueness
     *                                 check. Used during wizard-step validation
     *                                 to avoid an unnecessary query on every
     *                                 blur; the real registration submission
     *                                 always enforces it.
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function emailRules(?int $userId = null, bool $isPrecognitive = false): array
    {
        return [
            'required',
            'string',
            'email',
            'max:255',
            ...($isPrecognitive ? [] : [
                $userId === null
                ? Rule::unique(User::class)
                : Rule::unique(User::class)->ignore($userId),
            ]),
        ];
    }

    /**
     * Get the validation rules used to validate mobile numbers.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function phoneNumberRules(): array
    {
        return ['required', 'string', 'regex:/^(09|\+639)\d{9}$/'];
    }

    /**
     * Get the validation rules used to validate date of birth.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function dateOfBirthRules(): array
    {
        return ['required', 'date', 'before:-18 years'];
    }

    /**
     * Get the validation rules used to validate home address.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function addressRules(): array
    {
        return ['required', 'string', 'max:255'];
    }

    /**
     * Get the validation rules used to validate government ID type.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function idTypeRules(): array
    {
        return ['required', Rule::enum(IdType::class)];
    }

    /**
     * Get the validation rules used to validate government ID number.
     *
     * @return array<int, ValidationRule|array<mixed>|string>
     */
    protected function idNumberRules(): array
    {
        return ['required', 'string', 'max:50'];
    }
}
