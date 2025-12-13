@extends('layouts.mainDoctor')

@section('content')
  <div class="container">
    <div class="flex justify-between items-center mb-lg">
      <h1 class="page-title">{{ $project->project_name }}</h1>
      <a href="{{ route('doctor.home') }}" class="btn btn-outline">Back</a>
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
            <a href="{{ $project->github_link }}" target="_blank"
              style="text-decoration: underline">{{ $project->github_link }}</a>
          </div>
          <br>
          <div class="flex items-center gap-sm p-sm bg-gray-50 rounded" style="
                        background-color: var(--background-color);
                        border-radius: var(--radius-md);
                      ">
            <span class="text-secondary">Drive Link:</span>
            <a href="{{ $project->drive_link }}" target="_blank"
              style="text-decoration: underline">{{ $project->drive_link }}</a>
          </div>
        </div>

        <div class="card mb-md">
          <h2 class="section-title">Add Comment</h2>
          <form action="{{ route('doctor.project.comment', $project->project_id) }}" method="post">
            @csrf
            <div class="form-group">
              <textarea name="comment" class="form-textarea" rows="4" placeholder="Write your notes for the team here..."></textarea>
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
          <form action="Grading.html">
            <div class="form-group">
              <label class="form-label">Update Status</label>
              <select class="form-select mb-md">
                <option value="progress" selected>In Progress</option>
                <option value="edit">Needs Revision</option>
                <option value="delivered">Submitted</option>
              </select>
            </div>
            <button type="submit" class="btn btn-secondary btn-block">
              Save Changes
            </button>
            <p class="text-secondary small mt-sm text-center">
              * Selecting "Submitted" will redirect to grading page.
            </p>
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
