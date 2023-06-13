<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function loginWithGoogle(Request $request)
    {
        return $this->authService->loginWithGoogle($request);
    }

    public function callbackFromGoogle()
    {
        try {
            return $this->authService->callbackFromGoogle();
        } catch (\Throwable $e) {
            return redirect()->route('index')->with(['error' => $e]); 
        }
    }

    public function logout(){
        return $this->authService->logOut();
    }
}
