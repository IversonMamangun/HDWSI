<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GuardianApplicant extends Pivot
{
    protected $casts = [
        'consent_given_at' => 'datetime',
    ];
}
