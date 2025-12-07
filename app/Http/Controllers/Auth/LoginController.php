<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'password.required' => 'O campo senha é obrigatório.',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            return match($user->role) {
                'admin', 'employee', 'deliveryman' => redirect()->route('crm.dashboard')
                    ->with('success', 'Login realizado com sucesso!'),
                default => redirect()->intended(route('home'))
                    ->with('success', 'Login realizado com sucesso!')
            };
        }

        return back()
            ->withInput($request->only('email'))
            ->with('error', 'Senha e/ou e-mail está(ão) incorreto(s)!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Logout realizado com sucesso!');
    }
}
