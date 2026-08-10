<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class GuardianConsentController extends Controller
{
    public function show(User $applicant): Response
    {
        Gate::authorize('viewChildApplication', [User::class, $applicant]);

        return Inertia::render('guardian/Consent', [
            'applicant' => new UserResource($applicant),
        ]);
    }

    public function store(Request $request, User $applicant)
    {
        Gate::authorize('giveConsent', [User::class, $applicant]);

        $request->user()->linkedApplicants()->updateExistingPivot($applicant->id, [
            'consent_given_at' => now(),
        ]);

        return redirect()
            ->route('guardian.dashboard')
            ->with('status', 'Consent recorded — the applicant can now submit their application.');
    }

    public function dashboard(Request $request): Response
    {
        $applicants = $request->user()->linkedApplicants;

        return Inertia::render('guardian/Dashboard', [
            'applicants' => UserResource::collection($applicants),
        ]);
    }
}
