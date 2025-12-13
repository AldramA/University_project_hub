@extends('layouts.mainStudent')

@section('content')

  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <h1 class="page-title">{{ $project->project_name }} (Admin View)</h1>
      <span class="badge badge-info" style="font-size: 1rem; padding: 0.5rem 1rem">{{ $project->status }}</span>
    </div>

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
          <h2 class="section-title">Project Settings</h2>
          <form>
            <div class="form-group">
              <label class="form-label">Project Link (GitHub / Drive)</label>
              <div class="flex gap-sm">
                <input type="url" class="form-input" value="{{ $project->project_link }}" placeholder="https://..." />
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
        <div class="card mb-md">
          <h2 class="section-title">Doctor's Comments</h2>
          @foreach ($comments as $comment)
            <div class="p-md" style="
                            background-color: var(--background-color);
                            border-radius: var(--radius-md);
                          ">
              <div class="flex justify-between mb-sm">
                <strong>Dr. Ahmed Ali</strong>
                <span class="text-secondary"
                  style="font-size: var(--font-size-sm)">{{ $comment->created_at->diffForHumans() }}</span>
              </div>
              <p>
                {{ $comment->comment_text }}
              </p>
            </div>
          @endforeach
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

        <div class="card">
          <h2 class="section-title">Join Requests</h2>
          <div class="p-md border rounded" style="
                        border: 1px solid var(--border-color);
                        border-radius: var(--radius-md);
                      ">
            <div class="flex justify-between items-center">
              <div>
                <strong>Ahmed Abdullah</strong>
                <p class="text-secondary" style="font-size: var(--font-size-sm)">
                  Second Year
                </p>
              </div>
              <div class="flex gap-sm">
                <button class="btn btn-primary btn-sm">Accept</button>
                <button class="btn btn-danger btn-sm">Reject</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
