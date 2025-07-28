<?php

namespace App\Http\Controllers;

use App\Service\AccessToken\AccessTokenService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class TokenController extends Controller
{
    public function __construct(private readonly AccessTokenService $tokenService)
    {
    }
    
    public function show(Request $request, string $token): Response|RedirectResponse
    {
        $accessToken = $this->tokenService->getToken($token);
        
        if ( ! $accessToken) {
            return redirect()
                ->route('register')
                ->with('error_status', 'Link expired or invalid');
        }
        
        if ( ! $accessToken->isValid()) {
            return redirect()
                ->route('register')
                ->with('error_status', 'Link expired or invalid');
        }
        
        Auth::login($accessToken->user);
        
        return Inertia::render('tokens/index', [
            'token' => $accessToken->token,
            'success' => $request->session()->get('success')
        ]);
    }
    
    public function generate(Request $request, string $oldToken): RedirectResponse
    {
        $token = $this->tokenService->generateToken($request->user());
        $protectedUrl = route('tokens.view', ['token' => $token->token]);
        
        $this->tokenService->deactivateToken($this->tokenService->getToken($oldToken));
        
        return redirect()->route('tokens.view', [
            'token' => $token->token
        ])
            ->with('success', 'Token generated successfully new url is ' . $protectedUrl . '.');
    }
    
    public function deactivate(Request $request, string $token): RedirectResponse
    {
        $tokenModel = $this->tokenService->getToken($token);

        if ( ! $tokenModel) {
            return redirect()
                ->route('register')
                ->with('error_status', 'Token not found.');
        }
        
        if ($tokenModel->user_id !== auth()->id()) {
            return redirect()
                ->back()
                ->with('error', 'Unauthorized action.');
        }
        
        $this->tokenService->deactivateToken($tokenModel);
        
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()
            ->route('register')
            ->with('success', 'Token deactivated successfully.');
    }
}
