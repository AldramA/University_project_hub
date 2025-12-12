<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
  /**
   * Student Registration
   */
  public function register(Request $request)
  {
    // Validate input with unique email rule
    $validated = $request->validate([
      'full_name'  => ['required', 'string', 'max:255'],
      'email'      => [
        'required',
        'string',
        'email',
        'max:255',
        Rule::unique('students', 'email'),
        Rule::unique('doctors', 'email')
      ],
      'password'   => ['required', 'string', 'min:8', 'confirmed'],
      'phone'      => ['required', 'string', 'max:20'],
      'year'       => ['required', 'string', 'max:255'],
      'department' => ['required', 'string', 'max:255'],
    ], [
      'email.unique' => 'The email address is already in use.',
    ]);

    // Create student
    $student = Student::create([
      'full_name'  => $validated['full_name'],
      'email'      => $validated['email'],
      'password'   => Hash::make($validated['password']),
      'phone'      => $validated['phone'],
      'year'       => $validated['year'],
      'department' => $validated['department'],
    ]);

    // Login the student
    Auth::guard('student')->login($student);

    return redirect()->route('student.home')
      ->with('success', 'Registration successful!');
  }
  /**
   * Student Home Page
   */
  public function home()
  {
    $student = Auth::guard('student')->user();

    // Get student's projects
    $projects = Project::where('admin_id', $student->student_id)
      ->latest()
      ->get();

    return view('student.home', compact('student', 'projects'));
  }

  /**
   * Student Join Project Page
   */
  public function joinProject()
  {

    return view('student.joinProject');
  }

  /**
   * Student Profile Page
   */
  public function profile($id)
  {
    $student = Auth::guard('student')->user();

    // Authorization: Only allow students to view their own profile
    if ($student->student_id != $id) {
      abort(403, 'Unauthorized access to this page.');
    }

    return view('student.profile', compact('student'));
  }
}
