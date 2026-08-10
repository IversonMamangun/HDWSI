<?php

namespace App\Http\Controllers\Admin\Applicants;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ApproveApplicantController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $applicant)
    {
        Gate::authorize('approveApplicant', $applicant);

        if ($applicant->rejected_at) {
            return back()->withErrors([
                'approve' => 'This applicant was previously rejected. Clear the rejection before approving.',
            ]);
        }

        if ($applicant->is_minor && !$applicant->hasGuardianConsent()) {
            return back()->withErrors([
                'approve' => 'This applicant is a minor and their guardian has not yet given consent. They cannot be approved until consent is recorded.',
            ]);
        }

        $applicant->syncRoles([RoleEnum::MEMBER->value]);

        $applicant->update([
            'approved_at' => now(),
            'approved_by' => $request->user()->id,
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Applicant approved and promoted to member.',
        ]);

        return back();
    }
}
