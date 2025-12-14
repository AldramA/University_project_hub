@extends('layouts.mainDoctor')

@section('content')
  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <div>
        <h1 class="page-title">Welcome, Dr. {{ Auth::guard('doctor')->user()->full_name }}</h1>
        <p class="text-secondary">Manage student projects</p>
      </div>
      <a href="{{ route('doctor.dashboard') }}" class="btn btn-outline">Dashboard</a>
    </div>

    <h2 class="section-title">Courses & Projects</h2>

    @forelse ($courses as $course)
      <div class="card mb-lg">
        <div class="flex justify-between items-center mb-md border-b pb-sm">
          <h3 style="font-weight: bold; font-size: var(--font-size-lg)">
            {{ $course->course_name }}
          </h3>
          <span class="badge badge-info">
            {{ $course->projects->count() }} {{ $course->projects->count() == 1 ? 'project' : 'projects' }}
          </span>
        </div>

        <div class="grid md:grid-cols-2 gap-md">
          @forelse ($course->projects as $project)
            @php
              $statusLabels = ['not_graded' => 'Not Graded Yet', 'submitted' => 'Submitted', 'needs_work' => 'Needs More Work', 'pending' => 'Not Graded Yet'];
              $statusColors = ['not_graded' => '#6b7280', 'submitted' => '#10b981', 'needs_work' => '#f59e0b', 'pending' => '#6b7280'];
              $statusColor = $statusColors[$project->status] ?? '#6b7280';
            @endphp
            <div class="p-md border rounded" style="border: 1px solid var(--border-color); border-radius: var(--radius-md);">
              <div class="flex justify-between items-center mb-sm">
                <strong>{{ $project->project_name }}</strong>
                <span class="badge" style="background-color: {{ $statusColor }}; color: white;">
                  {{ $statusLabels[$project->status] ?? ucfirst($project->status) }}
                </span>
              </div>

              <p class="text-secondary small mb-sm">
                Admin: {{ $project->admin->full_name ?? 'N/A' }}
              </p>

              @if($project->grade !== null)
                <p class="mb-sm" style="font-weight: bold; color: var(--primary-color);">
                  Grade: {{ $project->grade }}/100
                </p>
              @endif

              <a href="{{ route('doctor.project', $project->project_id) }}" class="btn btn-primary btn-sm btn-block">Open
                Project</a>
            </div>
          @empty
            <p class="text-secondary">No projects in this course yet.</p>
          @endforelse
        </div>
      </div>
    @empty
      <div class="card">
        <p class="text-secondary text-center">No courses assigned yet.</p>
      </div>
    @endforelse
  </div>
@endsection