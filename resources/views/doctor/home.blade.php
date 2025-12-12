@extends('layouts.mainDoctor')

@section('content')
  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <h1 class="page-title">Welcome, Dr. {{ Auth::guard('doctor')->user()->full_name }}</h1>
      <p class="text-secondary">Manage student projects</p>
    </div>

    <h2 class="section-title">Courses & Projects</h2>

    <div class="card mb-lg">
      @foreach ($courses as $course)

        <div class="flex justify-between items-center mb-md border-b pb-sm">
          <h3 style="font-weight: bold; font-size: var(--font-size-lg)">
            {{ $course->course_name }}
          </h3>
          <span class="badge badge-info">
            {{ $course->projects->count() }} active projects
          </span>
        </div>

        <div class="grid md:grid-cols-2 gap-md">

          @foreach ($course->projects as $project)
            <div class="p-md border rounded" style="border: 1px solid var(--border-color); border-radius: var(--radius-md);">
              <div class="flex justify-between items-center mb-sm">
                <strong>{{ $project->project_name }}</strong>
                <span class="badge badge-info">In Progress</span>
              </div>

              <p class="text-secondary small mb-sm">
                Team: Mohamed Sobhy, Ahmed Hassan
              </p>

              <a href="{{ route('doctor.project', $project->project_id) }}" class="btn btn-primary btn-sm btn-block">Open Project</a>
            </div>
          @endforeach

        </div>

      @endforeach


    </div>
@endsection
