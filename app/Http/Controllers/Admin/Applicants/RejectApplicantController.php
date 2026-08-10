<?php

namespace App\Http\Controllers\Admin\Applicants;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class RejectApplicantController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, User $applicant)
    {
        Gate::authorize('rejectApplicant', $applicant);

        if ($applicant->approved_at) {
            return back()->withErrors([
                'reject' => 'This applicant was already approved. Consider revoking membership separately rather than rejecting here.',
            ]);
        }

        $validated = $request->validate([
            'reason' => ['required', 'string', 'max:500'],
        ]);

        $applicant->update([
            'rejected_at' => now(),
            'rejected_by' => $request->user()->id,
            'rejection_reason' => $validated['reason'],
        ]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Applicant rejected.',
        ]);

        return back();
    }
}
