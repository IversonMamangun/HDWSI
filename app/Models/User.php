<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Policies\ApplicationPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property-read int $id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $address
 * @property Carbon|null $date_of_birth
 * @property bool $is_minor
 * @property string|null $id_type
 * @property string|null $id_number
 */
#[UsePolicy(ApplicationPolicy::class)]
class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    use HasRoles;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'date_of_birth',
        'is_minor',
        'address',
        'id_type',
        'id_number',
        'approved_at',
        'approved_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'phone_number_verified_at' => 'datetime',
            'password' => 'hashed',
            'two_factor_confirmed_at' => 'datetime',
            'date_of_birth' => 'date',
            'is_minor' => 'boolean',
            'id_number' => 'encrypted',
            'approved_at' => 'datetime',
        ];
    }

    /**
     * Keep the is_minor column in sync whenever date_of_birth changes,
     * so the stored value never drifts from the computed one — this
     * runs on both create and update.
     */
    protected static function booted(): void
    {
        static::saving(function (User $user) {
            if ($user->isDirty('date_of_birth')) {
                $user->is_minor = static::isMinorForDateOfBirth(
                    $user->date_of_birth?->format('Y-m-d')
                );
            }
        });
    }

    /**
     * Get the user's full name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => trim("{$this->first_name} {$this->middle_name} {$this->last_name}"),
        )->shouldCache();
    }

    /**
     * Guardians linked to this user (when this user is a minor applicant).
     */
    public function guardians(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'guardian_applicant', 'applicant_id', 'guardian_id')
            ->withPivot(['relationship', 'consent_given_at'])
            ->withTimestamps();
    }

    /**
     * Applicants this user guards (when this user is a guardian).
     */
    public function linkedApplicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'guardian_applicant', 'guardian_id', 'applicant_id')
            ->withPivot(['relationship', 'consent_given_at'])
            ->withTimestamps();
    }

    /**
     * Check if this user has been given consent by a guardian.
     */
    public function hasGuardianConsent(): bool
    {
        return $this->guardians()->wherePivotNotNull('consent_given_at')->exists();
    }

    /**
     * Determine whether a given date of birth belongs to a minor (< 18).
     */
    public static function isMinorForDateOfBirth(?string $dateOfBirth): bool
    {
        return $dateOfBirth ? Carbon::parse($dateOfBirth)->age < 18 : false;
    }

    /**
     * The user who approved this applicant (if any).
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * The user who rejected this applicant (if any).
     */
    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Government ID document upload (a single photo/scan per user,
     * stored privately — never publicly accessible by URL).
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('government_id')
            ->singleFile()
            ->useDisk('private')
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'application/pdf',
            ]);
    }
}
