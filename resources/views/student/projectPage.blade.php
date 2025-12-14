@extends('layouts.mainStudent')

@section('content')

  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <h1 class="page-title">{{ $project->project_name }}</h1>
      @php
        $statusLabels = ['not_graded' => 'Not Graded Yet', 'submitted' => 'Submitted', 'needs_work' => 'Needs More Work', 'pending' => 'Not Graded Yet'];
      @endphp
      <span class="badge badge-info"
        style="font-size: 1rem; padding: 0.5rem 1rem">{{ $statusLabels[$project->status] ?? ucfirst($project->status) }}</span>
    </div>

    <div class="grid md:grid-cols-3 gap-lg">
      <!-- Main Content -->
      <div style="grid-column: span 2">
        <div class="card mb-md">
          <h2 class="section-title">Project Description</h2>
          <p class="text-secondary mb-md">
            {{ $project->description }}
          </p>

          <div class="flex gap-md mt-md pt-md border-t" style="border-top: 1px solid var(--border-color)">
            <div>
              <span class="text-secondary block" style="font-size: var(--font-size-sm)">Course</span>
              <strong>{{ $project->course->course_name ?? 'N/A' }}</strong>
            </div>
            <div>
              <span class="text-secondary block" style="font-size: var(--font-size-sm)">Supervisor</span>
              <strong>{{ $project->doctor->full_name ?? 'N/A' }}</strong>
            </div>
          </div>
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

        <div class="card">
          <h2 class="section-title">Project Files & Links</h2>
          <div class="flex items-center gap-sm">
            <span class="text-secondary">GitHub Link:</span>
            @if($project->github_link)
              <a href="{{ $project->github_link }}" target="_blank"
                style="text-decoration: underline">{{ $project->github_link }}</a>
            @else
              <span class="text-secondary">Not provided</span>
            @endif
          </div>
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

        <div class="card mb-md">
          <h2 class="section-title">Actions</h2>
          <a href="Portfolio.html" class="btn btn-outline btn-block mb-sm">View Portfolio</a>
        </div>
      </div>
    </div>
  </div>
@endsection