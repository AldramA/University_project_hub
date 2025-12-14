<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Course;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\JoinRequest;
use App\Models\Comment;

/**
 * ProjectsController
 *
 * Handles all project-related functionality for both students and doctors.
 *
 * Student Functions:
 * - Create and store projects
 * - View project pages (admin vs member view)
 * - Search for projects
 * - Request to join projects
 * - Approve/reject join requests (admin only)
 * - Update project links (admin only)
 *
 * Doctor Functions:
 * - Store comments on projects
 * - Update project status
 * - Grade projects
 */
class ProjectsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Student Project Management
    |--------------------------------------------------------------------------
    */

  /**
   * Display the create project form.
   *
   * Loads all available doctors and courses for the dropdown selections.
   *
   * @return \Illuminate\View\View
   */
  public function createProject()
  {
    $doctors = Doctor::all();
    $courses = Course::all();
    return view('student.createProject', compact('doctors', 'courses'));
  }

  /**
   * Store a new project.
   *
   * Creates a project with the current student as admin.
   *
   * @param  Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function storeProject(Request $request)
  {
    $validated = $request->validate([
      'project_name' => ['required', 'string', 'max:255'],
      'description'  => ['required', 'string', 'max:255'],
      'course_id'    => ['required', 'string', 'max:255'],
      'doctor_id'    => ['required', 'string', 'max:255'],
    ]);

    $validated['admin_id'] = auth()->guard('student')->user()->student_id;
    Project::create($validated);

    return redirect()->route('student.home');
  }

  /**
   * Display the project page.
   *
   * Shows different views based on user role:
   * - Student admin: projectAdminPage (with join requests)
   * - Student member: projectPage (view only)
   * - Doctor: doctor.project (with grading options)
   *
   * @param  int  $id  Project ID
   * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
   */
  public function projectPage($id)
  {
    $project = Project::findOrFail($id);
    $members = ProjectMember::where('project_id', $id)->get();

    // Student view
    $student = auth()->guard('student')->user();
    if ($student) {
      $comments = Comment::where('project_id', $id)->get();

      if ($student->student_id == $project->admin_id) {
        // Admin view - includes join requests
        $joinRequests = JoinRequest::where('project_id', $id)
          ->where('status', 'pending')
          ->get();
        return view('student.projectAdminPage', compact('project', 'members', 'comments', 'joinRequests'));
      } else {
        // Member view
        return view('student.projectPage', compact('project', 'members', 'comments'));
      }
    }

    // Doctor view
    $doctor = auth()->guard('doctor')->user();
    if ($doctor && $doctor->doctor_id == $project->doctor_id) {
      return view('doctor.project', compact('project', 'members'));
    }

    return redirect()->route('login');
  }

  /**
   * Search for projects by name.
   *
   * @param  Request  $request
   * @return \Illuminate\View\View
   */
  public function search(Request $request)
  {
    $search = $request->input('search');
    $projects = Project::where('project_name', 'like', "%$search%")->get();
    return view('layouts.components.search-results', compact('projects'));
  }

    /*
    |--------------------------------------------------------------------------
    | Join Request Management (Student)
    |--------------------------------------------------------------------------
    */

  /**
   * Request to join a project.
   *
   * Validates that the student is not the admin or already a member,
   * and creates a pending join request.
   *
   * @param  int  $id  Project ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function requestJoinProject($id)
  {
    $project = Project::findOrFail($id);
    $studentId = auth()->guard('student')->user()->student_id;

    // Check if student is the project admin
    if ($project->admin_id == $studentId) {
      return redirect()->route('student.join-project')
        ->withErrors(['error' => 'You cannot join your own project.']);
    }

    // Check if student already has a pending request
    $existingRequest = JoinRequest::where('project_id', $id)
      ->where('student_id', $studentId)
      ->where('status', 'pending')
      ->first();

    if ($existingRequest) {
      return redirect()->route('student.join-project')
        ->withErrors(['error' => 'You already have a pending join request for this project.']);
    }

    // Check if student is already a member
    $existingMember = ProjectMember::where('project_id', $id)
      ->where('student_id', $studentId)
      ->first();

    if ($existingMember) {
      return redirect()->route('student.join-project')
        ->withErrors(['error' => 'You are already a member of this project.']);
    }

    // Create join request
    JoinRequest::create([
      'project_id' => $id,
      'student_id' => $studentId,
      'status'     => 'pending',
    ]);

    return redirect()->route('student.join-project')
      ->with('success', 'Join request sent successfully! Waiting for approval.');
  }

  /**
   * Approve a join request (Admin only).
   *
   * Updates the request status and adds the student as a project member.
   *
   * @param  int  $id  JoinRequest ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function approveJoinRequest($id)
  {
    $request = JoinRequest::findOrFail($id);
    $project = Project::findOrFail($request->project_id);
    $student = auth()->guard('student')->user();

    // Authorization: Only project admin can approve
    if ($student->student_id != $project->admin_id) {
      return back()->withErrors(['error' => 'You are not authorized to approve this request.']);
    }

    // Update request status
    $request->update([
      'status'       => 'approved',
      'responded_at' => now(),
    ]);

    // Add student as project member
    ProjectMember::create([
      'project_id'  => $request->project_id,
      'student_id'  => $request->student_id,
      'role'        => 'member',
      'join_status' => 'approved',
    ]);

    return back()->with('success', 'Join request approved successfully!');
  }

  /**
   * Reject a join request (Admin only).
   *
   * @param  int  $id  JoinRequest ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function rejectJoinRequest($id)
  {
    $request = JoinRequest::findOrFail($id);
    $project = Project::findOrFail($request->project_id);
    $student = auth()->guard('student')->user();

    // Authorization: Only project admin can reject
    if ($student->student_id != $project->admin_id) {
      return back()->withErrors(['error' => 'You are not authorized to reject this request.']);
    }

    // Update request status
    $request->update([
      'status'       => 'rejected',
      'responded_at' => now(),
    ]);

    return back()->with('success', 'Join request rejected.');
  }

  /**
   * Update project links (Admin only).
   *
   * Allows project admin to set GitHub and Drive/project links.
   *
   * @param  Request  $request
   * @param  int  $id  Project ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateProjectLinks(Request $request, $id)
  {
    $project = Project::findOrFail($id);
    $student = auth()->guard('student')->user();

    // Authorization: Only project admin can update links
    if ($student->student_id != $project->admin_id) {
      return back()->withErrors(['error' => 'You are not authorized to update this project.']);
    }

    $validated = $request->validate([
      'github_link'  => ['nullable', 'url', 'max:500'],
      'project_link' => ['nullable', 'url', 'max:500'],
    ]);

    $project->update([
      'github_link'  => $validated['github_link'],
      'project_link' => $validated['project_link'],
    ]);

    return back()->with('success', 'Project links updated successfully!');
  }

    /*
    |--------------------------------------------------------------------------
    | Doctor Project Management
    |--------------------------------------------------------------------------
    */

  /**
   * Store a comment on a project (Doctor only).
   *
   * @param  Request  $request
   * @param  int  $id  Project ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function storeComment(Request $request, $id)
  {
    $validated = $request->validate([
      'comment' => ['required', 'string', 'max:255'],
    ]);

    Comment::create([
      'comment_text' => $validated['comment'],
      'project_id'   => $id,
      'doctor_id'    => auth()->guard('doctor')->user()->doctor_id,
    ]);

    return redirect()->route('doctor.home')
      ->with('success', 'Comment added successfully');
  }

  /**
   * Update project status (Doctor only).
   *
   * Status options: not_graded, submitted, needs_work
   *
   * @param  Request  $request
   * @param  int  $id  Project ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateProjectStatus(Request $request, $id)
  {
    $project = Project::findOrFail($id);
    $doctor = auth()->guard('doctor')->user();

    // Authorization: Only assigned doctor can update status
    if ($doctor->doctor_id != $project->doctor_id) {
      return back()->withErrors(['error' => 'You are not authorized to update this project.']);
    }

    $validated = $request->validate([
      'status' => ['required', 'string', 'in:not_graded,submitted,needs_work'],
    ]);

    // Cannot set status to 'submitted' without grading first
    if ($validated['status'] === 'submitted' && $project->grade === null) {
      return back()->withErrors(['error' => 'You must grade the project before marking it as Submitted.']);
    }

    $project->update(['status' => $validated['status']]);

    return back()->with('success', 'Project status updated successfully!');
  }

  /**
   * Grade a project (Doctor only).
   *
   * Allows doctor to assign a grade (0-100) and provide feedback.
   *
   * @param  Request  $request
   * @param  int  $id  Project ID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function gradeProject(Request $request, $id)
  {
    $project = Project::findOrFail($id);
    $doctor = auth()->guard('doctor')->user();

    // Authorization: Only assigned doctor can grade
    if ($doctor->doctor_id != $project->doctor_id) {
      return back()->withErrors(['error' => 'You are not authorized to grade this project.']);
    }

    $validated = $request->validate([
      'grade'    => ['nullable', 'numeric', 'min:0', 'max:100'],
      'feedback' => ['nullable', 'string', 'max:1000'],
    ]);

    $project->update([
      'grade'    => $validated['grade'],
      'feedback' => $validated['feedback'],
    ]);

    return back()->with('success', 'Project graded successfully!');
  }
}
