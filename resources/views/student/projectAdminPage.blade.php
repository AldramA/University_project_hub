@extends('layouts.mainStudent')

@section('content')

  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <h1 class="page-title">{{ $project->project_name }} (Admin View)</h1>
      @php
        $statusLabels = ['not_graded' => 'Not Graded Yet', 'submitted' => 'Submitted', 'needs_work' => 'Needs More Work', 'pending' => 'Not Graded Yet'];
        $statusColors = ['not_graded' => '#6b7280', 'submitted' => '#10b981', 'needs_work' => '#f59e0b', 'pending' => '#6b7280'];
        $statusColor = $statusColors[$project->status] ?? '#6b7280';
      @endphp
      <span class="badge"
        style="font-size: 1rem; padding: 0.5rem 1rem; background-color: {{ $statusColor }}; color: white;">{{ $statusLabels[$project->status] ?? ucfirst($project->status) }}</span>
    </div>

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

    <div class="grid md:grid-cols-3 gap-lg">
      <!-- Main Content -->
      <div style="grid-column: span 2">
        <div class="card mb-md">
          <h2 class="section-title">Project Description</h2>
          <p class="text-secondary mb-md">
            {{ $project->description }}
          </p>
        </div>

        <div class="card mb-md">
          <h2 class="section-title">Project Links</h2>
          <form action="{{ route('student.update-project-links', $project->project_id) }}" method="POST">
            @csrf
            <div class="form-group">
              <label class="form-label">GitHub Repository</label>
              <input type="url" name="github_link" class="form-input" value="{{ $project->github_link }}"
                placeholder="https://github.com/..." />
            </div>
            <div class="form-group">
              <label class="form-label">Drive / Project Link</label>
              <input type="url" name="project_link" class="form-input" value="{{ $project->project_link }}"
                placeholder="https://drive.google.com/..." />
            </div>
            <button type="submit" class="btn btn-primary">Save Links</button>
          </form>
        </div>
        <div class="card mb-md">
          <h2 class="section-title">Doctor's Comments</h2>
          @forelse ($comments as $comment)
            <div class="p-md mb-sm" style="
                                                    background-color: var(--background-color);
                                                    border-radius: var(--radius-md);
                                                  ">
              <div class="flex justify-between mb-sm">
                <strong>{{ $comment->doctor->full_name ?? 'Doctor' }}</strong>
                <span class="text-secondary"
                  style="font-size: var(--font-size-sm)">{{ $comment->created_at->diffForHumans() }}</span>
              </div>
              <p>
                {{ $comment->comment_text }}
              </p>
            </div>
          @empty
            <p class="text-secondary">No comments yet.</p>
          @endforelse
        </div>
      </div>

      <!-- Sidebar -->
      <div>
        <div class="card mb-md">
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

        @if($project->grade !== null)
          <div class="card mb-md">
            <h2 class="section-title">Grade & Feedback</h2>
            <div class="text-center mb-md">
              <span style="font-size: 2rem; font-weight: bold; color: var(--primary-color)">{{ $project->grade }}/100</span>
            </div>
            @if($project->feedback)
              <div class="p-md" style="background-color: var(--background-color); border-radius: var(--radius-md);">
                <p class="text-secondary" style="font-size: var(--font-size-sm); margin-bottom: 4px;">Doctor's Feedback:</p>
                <p>{{ $project->feedback }}</p>
              </div>
            @endif
          </div>
        @endif

        <div class="card">
          <h2 class="section-title">Join Requests</h2>
          @forelse ($joinRequests as $request)
            <div class="p-md border rounded mb-sm" style="
                                                      border: 1px solid var(--border-color);
                                                      border-radius: var(--radius-md);
                                                    ">
              <div class="flex justify-between items-center">
                <div>
                  <strong>{{ $request->student->full_name ?? 'Unknown' }}</strong>
                  <p class="text-secondary" style="font-size: var(--font-size-sm)">
                    {{ $request->student->year ?? '' }} - {{ $request->student->department ?? '' }}
                  </p>
                </div>
                <div class="flex gap-sm">
                  <form action="{{ route('student.approve-request', ['id' => $request->request_id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-sm">Accept</button>
                  </form>
                  <form action="{{ route('student.reject-request', ['id' => $request->request_id]) }}" method="POST"
                    style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <p class="text-secondary">No pending join requests.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
@endsection