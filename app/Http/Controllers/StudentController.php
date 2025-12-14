<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Project;
use App\Models\ProjectMember;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

/**
 * StudentController
 *
 * Handles all student-related authentication, pages, and profile management.
 * Students can register, view their home page, profile, and join projects.
 */
class StudentController extends Controller
{
  /**
   * Handle student registration.
   *
   * Validates input, creates a new student account, and automatically
   * logs in the new student.
   *
   * @param  Request  $request
   * @return \Illuminate\Http\RedirectResponse
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
   * Display the student's home page.
   *
   * Shows all projects where the student is either an admin or an approved member.
   *
   * @return \Illuminate\View\View
   */
  public function home()
  {
    $student = Auth::guard('student')->user();

    // Get projects where student is admin
    $adminProjects = Project::where('admin_id', $student->student_id)
      ->latest()
      ->get();

    // Get projects where student is a member (approved)
    $memberProjectIds = ProjectMember::where('student_id', $student->student_id)
      ->where('join_status', 'approved')
      ->pluck('project_id');

    $memberProjects = Project::whereIn('project_id', $memberProjectIds)
      ->latest()
      ->get();

    // Combine both collections
    $projects = $adminProjects->merge($memberProjects)->unique('project_id');

    return view('student.home', compact('student', 'projects'));
  }

  /**
   * Display the join project search page.
   *
   * @return \Illuminate\View\View
   */
  public function joinProject()
  {
    return view('student.joinProject');
  }

  /**
   * Display the student's profile page.
   *
   * Shows student information and all their projects (admin and member).
   * Only allows students to view their own profile.
   *
   * @param  int  $id  Student ID
   * @return \Illuminate\View\View
   * @throws \Symfony\Component\HttpKernel\Exception\HttpException
   */
  public function profile($id)
  {
    $student = Auth::guard('student')->user();

    // Authorization: Only allow students to view their own profile
    if ($student->student_id != $id) {
      abort(403, 'Unauthorized access to this page.');
    }

    // Get projects where student is admin
    $adminProjects = Project::where('admin_id', $student->student_id)->get();

    // Get projects where student is a member (approved)
    $memberProjectIds = ProjectMember::where('student_id', $student->student_id)
      ->where('join_status', 'approved')
      ->pluck('project_id');

    $memberProjects = Project::whereIn('project_id', $memberProjectIds)->get();

    // Combine both collections
    $projects = $adminProjects->merge($memberProjects)->unique('project_id');

    return view('student.profile', compact('student', 'projects'));
  }
}
