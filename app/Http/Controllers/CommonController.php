<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
  /**
   * Login
   */
  public function login(Request $request)
  {
    // Validate credentials
    $credentials = $request->validate([
      'email'    => ['required', 'string', 'email', 'max:255'],
      'password' => ['required', 'string', 'min:8'],
    ]);

    $remember = $request->boolean('remember');

    if (Auth::guard('student')->attempt($credentials, $remember)) {

      $request->session()->regenerate();

      return redirect()
        ->intended(route('student.home'))
        ->with('success', 'Login successful as Student!');
    }

    if (Auth::guard('doctor')->attempt($credentials, $remember)) {

      $request->session()->regenerate();

      return redirect()
        ->intended(route('doctor.home'))
        ->with('success', 'Login successful as Doctor!');
    }

    throw ValidationException::withMessages([
      'email' => ['The provided credentials are incorrect.'],
    ]);
  }

  /**
   * Logout
   */
  public function logout(Request $request)
  {
    if (Auth::guard('student')->check()) {
      Auth::guard('student')->logout();
    }
    if (Auth::guard('doctor')->check()) {
      Auth::guard('doctor')->logout();
    }
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')
      ->with('success', 'Logout successful!');
  }
}
