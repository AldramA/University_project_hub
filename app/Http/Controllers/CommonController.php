<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

/**
 * CommonController
 *
 * Handles authentication functionality shared between students and doctors.
 * Includes login and logout for both user types using Laravel Guards.
 */
class CommonController extends Controller
{
  /**
   * Handle user login for both students and doctors.
   *
   * Attempts authentication against student guard first, then doctor guard.
   * Uses Laravel's multi-auth guards for role-based authentication.
   *
   * @param  Request  $request
   * @return \Illuminate\Http\RedirectResponse
   * @throws ValidationException
   */
  public function login(Request $request)
  {
    // Validate credentials
    $credentials = $request->validate([
      'email'    => ['required', 'string', 'email', 'max:255'],
      'password' => ['required', 'string', 'min:8'],
    ]);

    $remember = $request->boolean('remember');

    // Try student authentication first
    if (Auth::guard('student')->attempt($credentials, $remember)) {
      $request->session()->regenerate();
      return redirect()
        ->intended(route('student.home'))
        ->with('success', 'Login successful as Student!');
    }

    // Try doctor authentication
    if (Auth::guard('doctor')->attempt($credentials, $remember)) {
      $request->session()->regenerate();
      return redirect()
        ->intended(route('doctor.home'))
        ->with('success', 'Login successful as Doctor!');
    }

    // Authentication failed
    throw ValidationException::withMessages([
      'email' => ['The provided credentials are incorrect.'],
    ]);
  }

  /**
   * Handle user logout for both students and doctors.
   *
   * Logs out the user from whichever guard they're authenticated with,
   * invalidates the session, and regenerates the CSRF token.
   *
   * @param  Request  $request
   * @return \Illuminate\Http\RedirectResponse
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
