<?php

namespace App\Http\Controllers\Auth;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterValidationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationValidationController extends Controller
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate registration wizard fields without creating a user.
     *
     */
    public function __invoke(RegisterValidationRequest $request)
    {
        return response()->noContent();
    }
}
