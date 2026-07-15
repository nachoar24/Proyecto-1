<?php

namespace App\Http\Controllers;

use App\Notifications\EmailChanged;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],
                'password' => [
                    'nullable',
                    Password::defaults(),
                ],
            ],
            [
                'name.required' => 'El nombre es obligatorio.',
                'name.max' => 'El nombre no puede superar los 255 caracteres.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'Debes ingresar un correo electrónico válido.',
                'email.max' => 'El correo electrónico no puede superar los 255 caracteres.',
                'email.unique' => 'Este correo electrónico ya está siendo utilizado.',
                'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            ]
        );

        $originalEmail = $user->email;

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (filled($validated['password'] ?? null)) {
            $data['password'] = $validated['password'];
        }

        $user->update($data);

        if ($originalEmail !== $user->email) {
            Notification::route('mail', $originalEmail)
                ->notify(new EmailChanged(
                    user: $user,
                    originalEmail: $originalEmail,
                ));
        }

        return to_route('profile.edit')
            ->with(
                'success',
                'El perfil fue actualizado correctamente.'
            );
    }
}