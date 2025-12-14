@extends('layouts.mainStudent')
@section('title', 'Create Project')
@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="container" style="max-width: 600px">
    <h1 class="page-title mb-lg">Create New Project</h1>

    <div class="card">
      <form action="{{ route('student.store-project') }}" method="POST">
        @csrf
        <div class="form-group">
          <label class="form-label">Project Name</label>
          <input name="project_name" type="text" class="form-input" placeholder="Enter project name" required />
        </div>

        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" class="form-textarea" rows="4" placeholder="Brief description of the project..."
            required></textarea>
        </div>

        <div class="form-group">
          <label class="form-label">Course</label>
          <select name="course_id" class="form-select" required>
            <option value="">Select Course</option>
            @foreach ($courses as $course)
              <option value="{{ $course->course_id }}">{{ $course->course_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="form-label">Supervisor (Doctor)</label>
          <select name="doctor_id" class="form-select" required>
            <option value="">Select Doctor</option>
            @foreach ($doctors as $doctor)
              <option value="{{ $doctor->doctor_id }}">Dr.{{ $doctor->full_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="flex gap-sm mt-lg">
          <a href="{{ route('student.home') }}" class="btn btn-outline" style="flex: 1">Cancel</a>
          <button type="submit" class="btn btn-primary" style="flex: 1">
            Create Project
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection