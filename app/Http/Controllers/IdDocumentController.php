<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;

class IdDocumentController extends Controller
{
    public function show(User $applicant)
    {
        Gate::authorize('viewIdDocument', $applicant);

        $media = $applicant->getFirstMedia('government_id');

        abort_if(!$media, 404);

        return response()->file($media->getPath(), [
            'Content-Type' => $media->mime_type,
            'Content-Disposition' => 'inline; filename="' . $media->file_name . '"',
        ]);
    }
}
