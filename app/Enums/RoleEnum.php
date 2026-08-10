<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SUPER_ADMIN = 'super-admin';
    case ADMIN = 'admin';
    case CONTENT_EDITOR = 'content-editor';
    case ACADEMIC_STAFF = 'academic-staff';
    case ADMISSIONS_OFFICER = 'admissions-officer';
    case MEMBER = 'member';
    case APPLICANT = 'applicant';
    case GUARDIAN = 'guardian';

    public function label(): string
    {
        return match ($this) {
            self::SUPER_ADMIN => 'Super Admin',
            self::ADMIN => 'Admin',
            self::CONTENT_EDITOR => 'Content Editor',
            self::ACADEMIC_STAFF => 'Academic Staff',
            self::ADMISSIONS_OFFICER => 'Admissions Officer',
            self::MEMBER => 'Member',
            self::APPLICANT => 'Applicant',
            self::GUARDIAN => 'Guardian',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * All cases as {value, label} pairs, ready to hand to the frontend
     * for a select input.
     *
     * @return array<int, array{value: string, label: string}>
     */
    public static function options(): array
    {
        return array_map(
            fn(self $case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::cases(),
        );
    }

    /**
     * Roles an admin can assign when creating/editing a staff account.
     * Excludes MEMBER, APPLICANT, and GUARDIAN, which are only ever set
     * via self-registration or the admissions/membership flow.
     *
     * @return array<int, self>
     */
    public static function staffCases(): array
    {
        return array_values(array_filter(
            self::cases(),
            fn(self $case) => !in_array($case, [self::MEMBER, self::APPLICANT, self::GUARDIAN], true),
        ));
    }

    /**
     * @return array<int, string>
     */
    public static function staffValues(): array
    {
        return array_map(fn(self $case) => $case->value, self::staffCases());
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function staffOptions(): array
    {
        return array_map(
            fn(self $case) => [
                'value' => $case->value,
                'label' => $case->label(),
            ],
            self::staffCases(),
        );
    }
}
