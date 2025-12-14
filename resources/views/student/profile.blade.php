@extends('layouts.mainStudent')
@section('title', 'Profile')

@section('content')
  <div class="container" style="max-width: 800px">
    @if ($errors->any())
      <div class="alert alert-danger"
        style="background: #ef4444; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
        @foreach ($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    @endif

    @if (session('success'))
      <div class="alert alert-success"
        style="background: #10b981; color: white; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
        {{ session('success') }}
      </div>
    @endif

    <!-- Profile Header -->
    <div class="card mb-lg">
      <div class="flex items-center gap-lg">
        @php
          $initials = collect(explode(' ', $student->full_name))
            ->map(fn($n) => mb_substr($n, 0, 1))
            ->take(2)
            ->join('');
        @endphp
        <div style="
                    width: 100px;
                    height: 100px;
                    background-color: var(--primary-color);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 2rem;
                    color: white;
                    font-weight: bold;
                  ">
          {{ $initials }}
        </div>
        <div>
          <h1 class="page-title" style="margin-bottom: 4px">{{ $student->full_name }}</h1>
          <p class="text-secondary">
            {{ $student->year }} • {{ $student->department }}
          </p>
          <p class="text-secondary" style="font-size: var(--font-size-sm)">
            📧 {{ $student->email }} • 📱 {{ $student->phone }}
          </p>
        </div>
      </div>
    </div>

    <!-- My Projects -->
    <h2 class="section-title">My Projects</h2>
    <div class="grid md:grid-cols-2 gap-md">
      @forelse ($projects as $project)
        @php
          $statusLabels = ['not_graded' => 'Not Graded Yet', 'submitted' => 'Submitted', 'needs_work' => 'Needs More Work', 'pending' => 'Not Graded Yet'];
          $statusColors = ['not_graded' => '#6b7280', 'submitted' => '#10b981', 'needs_work' => '#f59e0b', 'pending' => '#6b7280'];
          $statusColor = $statusColors[$project->status] ?? '#6b7280';
          $isAdmin = $project->admin_id == $student->student_id;
        @endphp
        <div class="card">
          <div class="flex justify-between items-center mb-sm">
            <h3 style="font-weight: bold">{{ $project->project_name }}</h3>
            <span class="badge"
              style="background-color: {{ $statusColor }}; color: white;">{{ $statusLabels[$project->status] ?? ucfirst($project->status) }}</span>
          </div>
          <p class="text-secondary mb-sm" style="font-size: var(--font-size-sm)">
            {{ Str::limit($project->description, 80) }}
          </p>
          @if($isAdmin)
            <span class="badge badge-success" style="font-size: 0.7rem; margin-bottom: 0.5rem;">Admin</span>
          @else
            <span class="badge badge-info" style="font-size: 0.7rem; margin-bottom: 0.5rem;">Member</span>
          @endif
          <a href="{{ route('student.project', $project->project_id) }}" class="btn btn-outline btn-sm btn-block">View
            Project</a>
        </div>
      @empty
        <p class="text-secondary">No projects yet. Create or join a project to get started!</p>
      @endforelse
    </div>
  </div>

@endsection