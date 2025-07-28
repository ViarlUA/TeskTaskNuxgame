<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Service\Auth\AuthService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('auth/Register', [
            'status' => $request->session()->get('status'),
            'error_status' => $request->session()->get('error_status'),
        ]);
    }
    
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(
        RegisterRequest $request,
        AuthService $service
    ): Response
    {
        $token = $service->register($request->getDto());
        
        $protectedUrl = route('tokens.view', ['token' => $token->token]);

        return Inertia::render('auth/Register',
            [
                'registrationSuccess' => true,
                'protectedUrl'        => $protectedUrl,
            ]);
    }
}
