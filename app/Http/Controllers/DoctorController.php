<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Project;
use App\Models\Course;

class DoctorController extends Controller
{
  /**
   * Doctor Home
   */
  public function home()
  {
    $doctor = Auth::guard('doctor')->user();

    if (!$doctor) {
      return redirect()->route('doctor.login.page')
        ->with('error', 'You must be logged in to access this page');
    }

    $doctor = Doctor::findOrFail($doctor->doctor_id);
    $courses = Course::with('projects')
      ->where('doctor_id', $doctor->doctor_id)
      ->get();


    return view('doctor.home', compact('doctor', 'courses'));
  }

  /**
   * Doctor Dashboard
   */
  public function dashboard()
  {
    $doctor = Auth::guard('doctor')->user();

    if (!$doctor) {
      return redirect()->route('doctor.login.page')
        ->with('error', 'You must be logged in to access this page');
    }

    $projects = Project::where('doctor_id', $doctor->doctor_id)->get();
    $statuses = ['needs_revision', 'completed', 'pending'];

    $statusCounts = [];
    foreach ($statuses as $status) {
      $statusCounts[$status] = 0;
    }

    foreach ($projects as $project) {
      if (in_array($project->status, $statuses)) {
        $statusCounts[$project->status]++;
      }
    }

    $pendingProjects = Project::where('doctor_id', $doctor->doctor_id)
      ->where('status', 'pending')
      ->get();

    return view('doctor.dashboard', compact('projects', 'statusCounts', 'pendingProjects'));
  }
}
