<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Course;
use App\Models\Project;
use App\Models\ProjectMember;
use App\Models\JoinRequest;
use App\Models\Comment;

class ProjectsController extends Controller
{
  /**==================
   * Student Create Project
  ====================*/
  public function createProject()
  {
    $doctors = Doctor::all();
    $courses = Course::all();
    return view('student.createProject', compact('doctors', 'courses'));
  }

  /**==================
   * Student Store Project
  ====================*/
  public function storeProject(Request $request)
  {
    $validated = $request->validate([
      'project_name' => ['required', 'string', 'max:255'],
      'description' => ['required', 'string', 'max:255'],
      'course_id' => ['required', 'string', 'max:255'],
      'doctor_id' => ['required', 'string', 'max:255'],
    ]);

    $validated['admin_id'] = auth()->guard('student')->user()->student_id;
    $project = Project::create($validated);

    return redirect()->route('student.home');
  }

  /**==================
   * Project Page
  ====================*/
  public function projectPage($id)
  {
    $project = Project::findOrFail($id);
    $members = ProjectMember::where('project_id', $id)->get();

    $student = auth()->guard('student')->user();
    if ($student) {
      $comments = Comment::where('project_id', $id)->get();
      if ($student->student_id == $project->admin_id) {
        // Get pending join requests for admin view
        $joinRequests = JoinRequest::where('project_id', $id)
          ->where('status', 'pending')
          ->get();
        return view('student.projectAdminPage', compact('project', 'members', 'comments', 'joinRequests'));
      } else {
        return view('student.projectPage', compact('project', 'members', 'comments'));
      }
    }

    $doctor = auth()->guard('doctor')->user();
    if ($doctor) {
      if ($doctor->doctor_id == $project->doctor_id) {
        return view('doctor.project', compact('project', 'members'));
      }
    }

    return redirect()->route('login');
  }

  /**==================
   * Search Project
  ====================*/
  public function search(Request $request)
  {
    $search = $request->input('search');
    $projects = Project::where('project_name', 'like', "%$search%")->get();
    return view('layouts.components.search-results', compact('projects'));
  }

  /**==================
   * Store Comment
  ====================*/
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


    return redirect()
      ->route('doctor.home')
      ->with('success', 'Comment added successfully');
  }

  /**==================
   * Join Project
====================*/
  public function requestJoinProject($id)
  {
    $project = Project::findOrFail($id);
    $studentId = auth()->guard('student')->user()->student_id;

    // Check if student is the project admin
    if ($project->admin_id == $studentId) {
      return redirect()->route('student.join-project')->withErrors(['error' => 'You cannot join your own project.']);
    }

    // Check if student already has a pending request
    $existingRequest = JoinRequest::where('project_id', $id)
      ->where('student_id', $studentId)
      ->where('status', 'pending')
      ->first();

    if ($existingRequest) {
      return redirect()->route('student.join-project')->withErrors(['error' => 'You already have a pending join request for this project.']);
    }

    // Check if student is already a member
    $existingMember = ProjectMember::where('project_id', $id)
      ->where('student_id', $studentId)
      ->first();

    if ($existingMember) {
      return redirect()->route('student.join-project')->withErrors(['error' => 'You are already a member of this project.']);
    }

    // Create join request
    JoinRequest::create([
      'project_id' => $id,
      'student_id' => $studentId,
      'status' => 'pending',
    ]);

    return redirect()->route('student.join-project')->with('success', 'Join request sent successfully! Waiting for approval.');
  }

  /**==================
   * Approve Join Request
  ====================*/
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
      'status' => 'approved',
      'responded_at' => now(),
    ]);

    // Add student as project member
    ProjectMember::create([
      'project_id' => $request->project_id,
      'student_id' => $request->student_id,
      'role' => 'member',
      'join_status' => 'approved',
    ]);

    return back()->with('success', 'Join request approved successfully!');
  }

  /**==================
   * Reject Join Request
  ====================*/
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
      'status' => 'rejected',
      'responded_at' => now(),
    ]);

    return back()->with('success', 'Join request rejected.');
  }
}
