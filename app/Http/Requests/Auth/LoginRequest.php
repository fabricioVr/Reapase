<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombreUsuario' => ['required', 'string'],
            'password' => ['required', 'string'], // 👈 cambiar 'clave' por 'password'
        ];
    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Buscar usuario por nombreUsuario
        $user = User::where('nombreUsuario', $this->nombreUsuario)->first();

        // Verificar la contraseña comparando 'password' del formulario con 'clave' en BD
        if (! $user || ! Hash::check($this->password, $user->clave)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'nombreUsuario' => trans('auth.failed'),
            ]);
        }

        Auth::login($user, $this->boolean('remember'));

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'nombreUsuario' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('nombreUsuario')).'|'.$this->ip());
    }
}
