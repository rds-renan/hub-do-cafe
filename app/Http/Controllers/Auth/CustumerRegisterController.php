<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class CustumerRegisterController extends Controller
{
    public function create()
    {
        return view('frontend.auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                ],
            ], [
                'name.required' => 'O nome é obrigatório.',
                'email.required' => 'O e-mail é obrigatório.',
                'email.unique' => 'Este e-mail já está cadastrado.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar cliente. Tente novamente.')
                ->withInput();
        }

        try {
            $custumer = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'client',
            ]);

            Auth::login($custumer);
            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao cadastrar cliente. Tente novamente.')
                ->withInput();
        }
    }
}
