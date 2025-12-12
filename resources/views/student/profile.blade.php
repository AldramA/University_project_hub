@extends('layouts.mainStudent')
@section('title', 'Profile')

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
  <div class="container" style="max-width: 800px">
    <div class="card mb-lg">
      <div class="flex items-center gap-lg">
        <div style="
                  width: 100px;
                  height: 100px;
                  background-color: #e5e7eb;
                  border-radius: 50%;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  font-size: 2rem;
                  color: #9ca3af;
                ">
          👤
        </div>
        <div>
          <h1 class="page-title" style="margin-bottom: 4px">{{ $student->full_name }}</h1>
          <p class="text-secondary">
            {{ $student->year_label }} • Computer Science Department
          </p>
          <div class="flex gap-sm mt-sm">
            <span class="badge badge-info">HTML / CSS</span>
            <span class="badge badge-info">Node.js</span>
            <span class="badge badge-info">React</span>
          </div>
        </div>
      </div>
    </div>

    <h2 class="section-title">My Projects</h2>
    <div class="grid md:grid-cols-2 gap-md">
      <div class="card">
        <div class="flex justify-between items-center mb-sm">
          <h3 style="font-weight: bold">Warehouse Management System</h3>
          <span class="badge badge-info">In Progress</span>
        </div>
        <p class="text-secondary mb-md" style="font-size: var(--font-size-sm)">
          A web system for university inventory management.
        </p>
        <a href="ProjectPage.html" class="btn btn-outline btn-sm btn-block">View Project</a>
      </div>
    </div>
  </div>

@endsection
