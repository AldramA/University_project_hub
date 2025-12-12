<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Course;
use App\Models\Project;

class ProjectsController extends Controller
{
  // ===================
  // Student Create Project
  // ===================
  public function createProject()
  {
    $doctors = Doctor::all();
    $courses = Course::all();
    return view('student.createProject', compact('doctors', 'courses'));
  }

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

  public function projectPage($id)
  {
    $project = Project::findOrFail($id);

    $student = auth()->guard('student')->user();
    if ($student) {
      if ($student->student_id == $project->admin_id) {
        return view('student.projectAdminPage', compact('project'));
      } else {
        return view('student.projectPage', compact('project'));
      }
    }

    $doctor = auth()->guard('doctor')->user();
    if ($doctor && $doctor->doctor_id == $project->doctor_id) {
      return view('doctor.project', compact('project'));
    }

    return redirect()->route('login');
  }
}
