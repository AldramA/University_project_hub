@extends('layouts.mainStudent')
@section('title', 'University Project Hub')
@section('content')

  <div class="container">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-md">
      <div>
        <h1 class="page-title">Welcome, {{$student->full_name}}</h1>
        <p class="text-secondary">Manage your academic projects</p>
      </div>
      <div class="flex gap-sm">
        <a href="{{ route('student.create-project') }}" class="btn btn-primary">
          <span style="margin-right: 8px">+</span> Create Project
        </a>
        <a href="{{ route('student.join-project') }}" class="btn btn-outline">Join Project</a>
      </div>
    </div>

    <!-- Projects List -->
    <h2 class="section-title">My Projects</h2>

    <div class="grid md:grid-cols-2 gap-md">
      @foreach ($projects as $project)
        <!-- Project Card -->
        <div class="card">
          <div class="flex justify-between items-center mb-sm">
            <h3 style="font-weight: bold; font-size: var(--font-size-lg)">
              {{$project->project_name}}
            </h3>
            <span class="badge badge-info">In Progress</span>
          </div>
          <p class="text-secondary mb-md" style="font-size: var(--font-size-sm)">
            {{$project->description}}
            operations.
          </p>

          <div class="mb-md p-md" style="
                          background-color: var(--background-color);
                          border-radius: var(--radius-md);
                        ">
            <p class="text-secondary" style="font-size: 0.8rem; margin-bottom: 4px">
              Latest comment from Dr. Ahmed Ali:
            </p>
            <p style="font-size: var(--font-size-sm)">
              Please add more details about the user interfaces in the next
              report.
            </p>
          </div>

          <a href="{{ route('student.project', $project->project_id) }}" class="btn btn-primary btn-block">Open Project</a>
        </div>
      @endforeach
    </div>
  </div>

@endsection
