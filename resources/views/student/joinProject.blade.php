@extends('layouts.mainStudent')
@section('title', 'Join Project')
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
    <h1 class="page-title mb-lg">Join a Project</h1>

    <!-- Search Section -->
    <div class="card mb-lg">
      <div class="flex gap-sm">
        <input type="text" class="form-input" placeholder="Search for projects..." style="flex: 1" />
        <button class="btn btn-primary">Search</button>
      </div>
    </div>

    <!-- Results -->
    <h2 class="section-title">Available Projects</h2>

    <div class="grid md:grid-cols-2 gap-md">
      <div class="card">
        <div class="flex justify-between items-center mb-sm">
          <h3 style="font-weight: bold">Library Management System</h3>
          <span class="badge badge-success">Open</span>
        </div>
        <p class="text-secondary small mb-sm">Admin: Sara Ali</p>
        <p class="text-secondary small mb-md">Members: 2/4</p>
        <button class="btn btn-primary btn-block">Request to Join</button>
      </div>

      <div class="card">
        <div class="flex justify-between items-center mb-sm">
          <h3 style="font-weight: bold">Attendance Tracking App</h3>
          <span class="badge badge-success">Open</span>
        </div>
        <p class="text-secondary small mb-sm">Admin: Ahmed Mohamed</p>
        <p class="text-secondary small mb-md">Members: 1/3</p>
        <button class="btn btn-primary btn-block">Request to Join</button>
      </div>
    </div>
  </div>

@endsection