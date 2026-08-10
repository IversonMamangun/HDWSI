<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class GuardianConsentController extends Controller
{
    public function show(User $applicant): Response
    {
        return Inertia::render('Guardian/Consent', [
            'applicant' => [
                'id' => $applicant->id,
                'name' => $applicant->name,
                'email' => $applicant->email,
                'phone_number' => $applicant->phone_number,
                'date_of_birth' => $applicant->date_of_birth?->format('Y-m-d'),
            ],
        ]);
    }

    public function store(Request $request, User $applicant)
    {
        Gate::authorize('giveConsent', [User::class, $applicant]);

        $request->user()->linkedApplicants()->updateExistingPivot($applicant->id, [
            'consent_given_at' => now(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with('status', 'Consent recorded — the applicant can now submit their application.');
    }
}
