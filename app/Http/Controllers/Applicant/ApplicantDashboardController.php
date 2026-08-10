<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ApplicantDashboardController extends Controller
{
    public function show(Request $request): Response
    {
        $applicant = $request->user()->load('guardians');

        return Inertia::render('applicant/Dashboard', [
            'applicant' => new UserResource($applicant),
        ]);
    }
}
