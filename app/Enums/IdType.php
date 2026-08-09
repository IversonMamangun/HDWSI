<?php

namespace App\Enums;

enum IdType: string
{
    case PhilId = 'philid';
    case Passport = 'passport';
    case DriversLicense = 'drivers_license';
    case Umid = 'umid';
    case Sss = 'sss';
    case PhilHealth = 'philhealth';
    case Voters = 'voters';
    case Prc = 'prc';
    case Postal = 'postal';
    case Tin = 'tin';
    case SchoolId = 'school_id';

    /**
     * Human-readable label for display in selects, tables, etc.
     */
    public function label(): string
    {
        return match ($this) {
            self::PhilId => 'PhilSys National ID',
            self::Passport => 'Passport',
            self::DriversLicense => "Driver's License",
            self::Umid => 'UMID',
            self::Sss => 'SSS ID',
            self::PhilHealth => 'PhilHealth ID',
            self::Voters => "Voter's ID",
            self::Prc => 'PRC ID',
            self::Postal => 'Postal ID',
            self::Tin => 'TIN ID',
            self::SchoolId => 'School ID',
        };
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
}
