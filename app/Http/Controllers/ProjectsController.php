<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Course;
use App\Models\Project;
use App\Models\ProjectMember;
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
      if ($student->student_id == $project->admin_id) {
        return view('student.projectAdminPage', compact('project', 'members'));
      } else {
        return view('student.projectPage', compact('project', 'members'));
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
}
