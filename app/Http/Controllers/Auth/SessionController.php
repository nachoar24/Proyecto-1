<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        if (! Auth::attempt($validated)) {
            return back()
                ->withErrors([
                    'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended('/ideas')->with('success', 'Has iniciado sesión correctamente.');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Has cerrado sesión correctamente.');
    }
}
