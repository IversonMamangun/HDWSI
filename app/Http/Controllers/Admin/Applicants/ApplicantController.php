<?php

namespace App\Http\Controllers\Admin\Applicants;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        Gate::authorize('viewApplicantList', User::class);

        $allowedSorts = ['first_name', 'last_name', 'email', 'created_at'];

        $sort = $request->string('sort')->value();
        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'created_at';
        }

        $direction = $request->string('direction')->value() === 'asc' ? 'asc' : 'desc';

        $applicants = User::query()
            ->role(RoleEnum::APPLICANT->value)
            ->with('roles')
            ->when(
                $request->filled('search'),
                function ($query) use ($request) {
                    $search = $request->string('search');

                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                }
            )
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('admin/applicants/Index', [
            'applicants' => UserResource::collection($applicants),
            'filters' => [
                'search' => $request->string('search')->value(),
            ],
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $applicant): Response
    {
        Gate::authorize('viewIdDocument', $applicant);

        return Inertia::render('admin/applicants/Show', [
            'applicant' => new UserResource($applicant->load('guardians')),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
