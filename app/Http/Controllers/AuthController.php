<?php
namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterEmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login', [
            'rememberedEmail' => request()->cookie('remembered_email'),
        ]);
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $response = redirect()->intended(
                Auth::user()->isAdmin() ? route('dashboard.admin') : route('dashboard.staff')
            );

            if ($request->boolean('remember')) {
                $response->withCookie(cookie('remembered_email', $credentials['email'], 43200)); // 30 days
            } else {
                $response->withCookie(cookie()->forget('remembered_email'));
            }

            return $response;
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(RegisterEmployeeRequest $request): RedirectResponse
    {
        $employee = Employee::create([
            ...$request->validated(),
            'password' => Hash::make($request->validated()['password']),
            'role' => 'staff',
        ]);

        Auth::login($employee);

        return redirect()->route('dashboard.staff');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
