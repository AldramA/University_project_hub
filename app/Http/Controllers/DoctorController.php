<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Project;
use App\Models\Course;

/**
 * DoctorController
 *
 * Handles all doctor-related page views and functionality.
 * Doctors can view their home page, dashboard, and access their supervised projects.
 */
class DoctorController extends Controller
{
  /**
   * Display the doctor's home page.
   *
   * Shows all courses assigned to the doctor with their associated projects.
   *
   * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
   */
  public function home()
  {
    $doctor = Auth::guard('doctor')->user();

    if (!$doctor) {
      return redirect()->route('login')
        ->with('error', 'You must be logged in to access this page');
    }

    $doctor = Doctor::findOrFail($doctor->doctor_id);
    $courses = Course::with('projects')
      ->where('doctor_id', $doctor->doctor_id)
      ->get();

    return view('doctor.home', compact('doctor', 'courses'));
  }

  /**
   * Display the doctor's dashboard with project statistics.
   *
   * Shows project counts by status and lists pending projects
   * that require attention.
   *
   * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
   */
  public function dashboard()
  {
    $doctor = Auth::guard('doctor')->user();

    if (!$doctor) {
      return redirect()->route('login')
        ->with('error', 'You must be logged in to access this page');
    }

    $projects = Project::where('doctor_id', $doctor->doctor_id)->get();

    // Count projects by status
    $statuses = ['needs_work', 'submitted', 'not_graded'];
    $statusCounts = [];
    foreach ($statuses as $status) {
      $statusCounts[$status] = 0;
    }
    foreach ($projects as $project) {
      if (in_array($project->status, $statuses)) {
        $statusCounts[$project->status]++;
      }
    }

    // Get projects that are not yet graded
    $pendingProjects = Project::where('doctor_id', $doctor->doctor_id)
      ->where('status', 'not_graded')
      ->orWhere('status', 'pending')
      ->get();

    return view('doctor.dashboard', compact('projects', 'statusCounts', 'pendingProjects'));
  }
}
