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
   * Display the doctor's dashboard with comprehensive project statistics.
   *
   * Shows:
   * - Total project counts
   * - Projects by status
   * - Average grade
   * - Projects awaiting grading
   * - Recently graded projects
   * - All projects list
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

    // Get all projects for this doctor
    $projects = Project::where('doctor_id', $doctor->doctor_id)
      ->with(['course', 'admin'])
      ->get();

    // Count projects by status
    $statusCounts = [
      'not_graded' => 0,
      'submitted' => 0,
      'needs_work' => 0,
    ];

    foreach ($projects as $project) {
      $status = $project->status;
      // Map old statuses to new ones
      if ($status === 'pending') $status = 'not_graded';

      if (isset($statusCounts[$status])) {
        $statusCounts[$status]++;
      }
    }

    // Calculate average grade (only for graded projects)
    $gradedProjects = $projects->whereNotNull('grade');
    $averageGrade = $gradedProjects->count() > 0
      ? round($gradedProjects->avg('grade'), 1)
      : null;

    // Projects awaiting grading (not_graded or pending status)
    $pendingProjects = $projects->filter(function ($project) {
      return in_array($project->status, ['not_graded', 'pending']);
    });

    // Recently graded projects (last 5)
    $recentlyGraded = Project::where('doctor_id', $doctor->doctor_id)
      ->whereNotNull('grade')
      ->with(['course', 'admin'])
      ->orderBy('updated_at', 'desc')
      ->take(5)
      ->get();

    // Total counts
    $totalProjects = $projects->count();
    $totalGraded = $gradedProjects->count();

    return view('doctor.dashboard', compact(
      'projects',
      'statusCounts',
      'pendingProjects',
      'recentlyGraded',
      'averageGrade',
      'totalProjects',
      'totalGraded'
    ));
  }
}
