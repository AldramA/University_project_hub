@extends('layouts.mainDoctor')

@section('content')

  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <h1 class="page-title">Dashboard</h1>
      <p class="text-secondary">Project Statistics</p>
    </div>

    <div class="grid md:grid-cols-3 gap-lg mb-xl">
      <div class="card text-center" style="text-align: center">
        <h3 class="text-secondary mb-sm" style="font-size: var(--font-size-sm); font-weight: normal">
          In Progress
        </h3>
        <div style="font-size: 2.5rem; font-weight: bold; color: var(--primary-color);">
          {{ $statusCounts['pending'] }}
        </div>
        <p class="text-secondary small">projects</p>
      </div>

      <div class="card text-center" style="text-align: center">
        <h3 class="text-secondary mb-sm" style="font-size: var(--font-size-sm); font-weight: normal">
          Needs Revision
        </h3>
        <div style="font-size: 2.5rem; font-weight: bold; color: var(--accent-color);">
          {{ $statusCounts['needs_revision'] }}
        </div>
        <p class="text-secondary small">projects</p>
      </div>

      <div class="card text-center" style="text-align: center">
        <h3 class="text-secondary mb-sm" style="font-size: var(--font-size-sm); font-weight: normal">
          Submitted
        </h3>
        <div style="font-size: 2.5rem; font-weight: bold; color: var(--secondary-color);">
          {{ $statusCounts['completed'] }}
        </div>
        <p class="text-secondary small">projects</p>
      </div>
    </div>

    <h2 class="section-title">Projects Awaiting Grading</h2>
    <div class="card">
      @foreach ($pendingProjects as $project)
      <div class="p-md border-b" style="border-bottom: 1px solid var(--border-color)">
        <div class="flex justify-between items-center">
          <div>
            <strong>{{ $project->project_name }}</strong>
            <p class="text-secondary small">{{ $project->course->course_name }}</p>
          </div>
          <a href="Grading.html" class="btn btn-primary btn-sm">Grade Now</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>

@endsection
