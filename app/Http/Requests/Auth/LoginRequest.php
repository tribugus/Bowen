<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Cookie;


class LoginRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'correo' => ['required', 'string', 'email'],
            'contrasena' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'correo.required' => 'El campo de correo electrónico es obligatorio.',
            'correo.email' => 'Por favor, ingresa una dirección de correo electrónico válida.',
            'contrasena.required' => 'El campo de contraseña es obligatorio.',
        ];
    }




    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $credentials = $this->only('correo', 'contrasena');

        $usuario = Usuario::with('roll')->where('correo', $credentials['correo'])->first();

        if ($usuario && Hash::check($credentials['contrasena'], $usuario->contrasena)) {

            $usuarioJson = json_encode($usuario);
            Cookie::queue('usuario', $usuarioJson,700);

        } else {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'correo' => 'Las credenciales son incorrectas.',
                //'email' => trans('auth.failed'),
            ]);
        }
    }




    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'correo' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('correo')).'|'.$this->ip());
    }
}
