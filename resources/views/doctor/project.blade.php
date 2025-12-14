@extends('layouts.mainDoctor')

@section('content')
  <div class="container">
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

    <div class="flex justify-between items-center mb-lg">
      <h1 class="page-title">{{ $project->project_name }}</h1>
      @php
        $statusLabels = ['not_graded' => 'Not Graded Yet', 'submitted' => 'Submitted', 'needs_work' => 'Needs More Work', 'pending' => 'Not Graded Yet'];
      @endphp
      <div class="flex gap-sm items-center">
        <span class="badge badge-info"
          style="font-size: 1rem; padding: 0.5rem 1rem">{{ $statusLabels[$project->status] ?? ucfirst($project->status) }}</span>
        <a href="{{ route('doctor.home') }}" class="btn btn-outline">Back</a>
      </div>
    </div>

    <div class="grid md:grid-cols-3 gap-lg">
      <!-- Main Content -->
      <div style="grid-column: span 2">
        <div class="card mb-md">
          <h2 class="section-title">Project Details</h2>
          <p class="text-secondary mb-md">
            {{ $project->description }}
          </p>
          <div class="flex items-center gap-sm p-sm bg-gray-50 rounded" style="
                              background-color: var(--background-color);
                              border-radius: var(--radius-md);
                            ">
            <span class="text-secondary">Github Link:</span>
            @if($project->github_link)
              <a href="{{ $project->github_link }}" target="_blank"
                style="text-decoration: underline">{{ $project->github_link }}</a>
            @else
              <span class="text-secondary">Not provided</span>
            @endif
          </div>
          <br>
          <div class="flex items-center gap-sm p-sm bg-gray-50 rounded" style="
                              background-color: var(--background-color);
                              border-radius: var(--radius-md);
                            ">
            <span class="text-secondary">Project Link:</span>
            @if($project->project_link)
              <a href="{{ $project->project_link }}" target="_blank"
                style="text-decoration: underline">{{ $project->project_link }}</a>
            @else
              <span class="text-secondary">Not provided</span>
            @endif
          </div>
        </div>

        <div class="card mb-md">
          <h2 class="section-title">Add Comment</h2>
          <form action="{{ route('doctor.project.comment', $project->project_id) }}" method="post">
            @csrf
            <div class="form-group">
              <textarea name="comment" class="form-textarea" rows="4"
                placeholder="Write your notes for the team here..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
              Send Comment
            </button>
          </form>
        </div>
      </div>

      <!-- Sidebar -->
      <div>
        <div class="card mb-md">
          <h2 class="section-title">Project Status</h2>
          <form action="{{ route('doctor.project.update-status', $project->project_id) }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-label">Update Status</label>
              <select name="status" class="form-select mb-md">
                <option value="not_graded" {{ $project->status == 'not_graded' || $project->status == 'pending' ? 'selected' : '' }}>Not Graded Yet</option>
                <option value="submitted" {{ $project->status == 'submitted' ? 'selected' : '' }}>Submitted</option>
                <option value="needs_work" {{ $project->status == 'needs_work' || $project->status == 'needs_revision' ? 'selected' : '' }}>Needs More Work</option>
              </select>
            </div>
            <button type="submit" class="btn btn-secondary btn-block">
              Save Status
            </button>
          </form>
        </div>

        <div class="card mb-md">
          <h2 class="section-title">Grade Project</h2>
          <form action="{{ route('doctor.project.grade', $project->project_id) }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-label">Grade (0-100)</label>
              <input type="number" name="grade" class="form-input" min="0" max="100" step="0.5"
                value="{{ $project->grade }}" placeholder="Enter grade...">
            </div>
            <div class="form-group">
              <label class="form-label">Feedback</label>
              <textarea name="feedback" class="form-textarea" rows="3"
                placeholder="Write feedback...">{{ $project->feedback }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">
              Save Grade
            </button>
          </form>
        </div>

        <div class="card">
          <h2 class="section-title">Team Members</h2>
          <ul class="flex flex-col gap-sm">
            <li class="flex items-center gap-sm">
              @php
                $adminName = $project->admin->full_name;
                $initials = collect(explode(' ', $adminName))
                  ->map(fn($n) => mb_substr($n, 0, 1))
                  ->take(2)
                  ->join('');
              @endphp
              <div style="
                                  width: 32px;
                                  height: 32px;
                                  background-color: var(--primary-color);
                                  border-radius: 50%;
                                  display: flex;
                                  align-items: center;
                                  justify-content: center;
                                  color: white;
                                  font-size: 12px;
                                ">
                {{ $initials }}
              </div>
              <div>
                <div style="font-weight: bold">{{ $adminName }}</div>
                <span class="badge badge-success" style="font-size: 0.7rem">Admin</span>
              </div>
            </li>
            @foreach ($members as $member)
              @php
                $name = $member->student?->full_name;
                $initials = collect(explode(' ', $name))
                  ->map(fn($n) => mb_substr($n, 0, 1))
                  ->take(2)
                  ->join('');
              @endphp
              <li class="flex items-center gap-sm">
                <div style="
                                              width: 32px;
                                              height: 32px;
                                              background-color: var(--secondary-color);
                                              border-radius: 50%;
                                              display: flex;
                                              align-items: center;
                                              justify-content: center;
                                              color: white;
                                              font-size: 12px;
                                            ">
                  {{ $initials }}
                </div>
                <div>{{ $member->student->full_name }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection