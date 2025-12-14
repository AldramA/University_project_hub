@extends('layouts.mainDoctor')

@section('content')
  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <div>
        <h1 class="page-title">Dashboard</h1>
        <p class="text-secondary">Project Statistics</p>
      </div>
      <a href="{{ route('doctor.home') }}" class="btn btn-outline">Back to Home</a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid md:grid-cols-3 gap-lg mb-xl">
      <div class="card text-center" style="text-align: center">
        <h3 class="text-secondary mb-sm" style="font-size: var(--font-size-sm); font-weight: normal">
          Not Graded Yet
        </h3>
        <div style="font-size: 2.5rem; font-weight: bold; color: #6b7280;">
          {{ $statusCounts['not_graded'] ?? 0 }}
        </div>
        <p class="text-secondary small">projects</p>
      </div>

      <div class="card text-center" style="text-align: center">
        <h3 class="text-secondary mb-sm" style="font-size: var(--font-size-sm); font-weight: normal">
          Needs More Work
        </h3>
        <div style="font-size: 2.5rem; font-weight: bold; color: #f59e0b;">
          {{ $statusCounts['needs_work'] ?? 0 }}
        </div>
        <p class="text-secondary small">projects</p>
      </div>

      <div class="card text-center" style="text-align: center">
        <h3 class="text-secondary mb-sm" style="font-size: var(--font-size-sm); font-weight: normal">
          Submitted
        </h3>
        <div style="font-size: 2.5rem; font-weight: bold; color: #10b981;">
          {{ $statusCounts['submitted'] ?? 0 }}
        </div>
        <p class="text-secondary small">projects</p>
      </div>
    </div>

    <!-- Projects Awaiting Grading -->
    <h2 class="section-title">Projects Awaiting Grading</h2>
    <div class="card">
      @forelse ($pendingProjects as $project)
        <div class="p-md border-b" style="border-bottom: 1px solid var(--border-color)">
          <div class="flex justify-between items-center">
            <div>
              <strong>{{ $project->project_name }}</strong>
              <p class="text-secondary small">{{ $project->course->course_name ?? 'N/A' }}</p>
            </div>
            <a href="{{ route('doctor.project', $project->project_id) }}" class="btn btn-primary btn-sm">Grade Now</a>
          </div>
        </div>
      @empty
        <p class="text-secondary text-center p-md">No projects awaiting grading.</p>
      @endforelse
    </div>
  </div>
@endsection