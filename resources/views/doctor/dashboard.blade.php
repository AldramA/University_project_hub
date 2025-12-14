@extends('layouts.mainDoctor')

@section('content')
  <style>
    .dashboard-container {
      max-width: 1000px;
      margin: 0 auto;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      margin-bottom: 2rem;
    }

    @media (max-width: 768px) {
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    .stat-box {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 1.5rem;
      text-align: center;
    }

    .stat-box .number {
      font-size: 2.5rem;
      font-weight: 700;
      margin: 0.25rem 0;
    }

    .stat-box .label {
      font-size: 0.75rem;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .section-card {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      overflow: hidden;
    }

    .section-header {
      padding: 1rem 1.25rem;
      border-bottom: 1px solid #e5e7eb;
      font-weight: 600;
      font-size: 1rem;
    }

    .project-item {
      padding: 1rem 1.25rem;
      border-bottom: 1px solid #f3f4f6;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .project-item:last-child {
      border-bottom: none;
    }

    .project-item:hover {
      background: #f9fafb;
    }

    .project-name {
      font-weight: 500;
      margin-bottom: 0.25rem;
    }

    .project-meta {
      font-size: 0.85rem;
      color: #6b7280;
    }

    .status-badge {
      padding: 0.35rem 0.75rem;
      border-radius: 20px;
      font-size: 0.75rem;
      font-weight: 500;
    }

    .status-gray {
      background: #f3f4f6;
      color: #374151;
    }

    .status-orange {
      background: #fef3c7;
      color: #92400e;
    }

    .status-green {
      background: #d1fae5;
      color: #065f46;
    }

    .grade-circle {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: linear-gradient(135deg, #6366f1, #8b5cf6);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 0.9rem;
    }

    .empty-msg {
      padding: 2rem;
      text-align: center;
      color: #9ca3af;
    }

    .two-cols {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }

    @media (max-width: 768px) {
      .two-cols {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <div class="dashboard-container">
    <!-- Header -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
      <div>
        <h1 style="font-size: 1.5rem; font-weight: 600; margin: 0;">Dashboard</h1>
        <p style="color: #6b7280; margin: 0.25rem 0 0 0;">Welcome back, Dr. {{ Auth::guard('doctor')->user()->full_name }}
        </p>
      </div>
      <a href="{{ route('doctor.home') }}" class="btn btn-outline">← Home</a>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-box">
        <div class="label">Total</div>
        <div class="number" style="color: #6366f1;">{{ $totalProjects }}</div>
        <div class="label">Projects</div>
      </div>
      <div class="stat-box">
        <div class="label">Graded</div>
        <div class="number" style="color: #10b981;">{{ $totalGraded }}</div>
        <div class="label">Completed</div>
      </div>
      <div class="stat-box">
        <div class="label">Pending</div>
        <div class="number" style="color: #f59e0b;">{{ $pendingProjects->count() }}</div>
        <div class="label">To Review</div>
      </div>
      <div class="stat-box">
        <div class="label">Average</div>
        <div class="number" style="color: #8b5cf6;">{{ $averageGrade ?? '—' }}</div>
        <div class="label">Grade</div>
      </div>
    </div>

    <!-- Two Column Section -->
    <div class="two-cols">
      <!-- Pending Projects -->
      <div class="section-card">
        <div class="section-header">📋 Needs Grading ({{ $pendingProjects->count() }})</div>
        @forelse ($pendingProjects->take(5) as $project)
          <div class="project-item">
            <div>
              <div class="project-name">{{ $project->project_name }}</div>
              <div class="project-meta">{{ $project->course->course_name ?? 'N/A' }}</div>
            </div>
            <a href="{{ route('doctor.project', $project->project_id) }}" class="btn btn-primary btn-sm">Grade</a>
          </div>
        @empty
          <div class="empty-msg">All projects graded! 🎉</div>
        @endforelse
      </div>

      <!-- Recently Graded -->
      <div class="section-card">
        <div class="section-header">✅ Recently Graded</div>
        @forelse ($recentlyGraded->take(5) as $project)
          <div class="project-item">
            <div>
              <div class="project-name">{{ $project->project_name }}</div>
              <div class="project-meta">{{ $project->updated_at->diffForHumans() }}</div>
            </div>
            <div class="grade-circle">{{ $project->grade }}</div>
          </div>
        @empty
          <div class="empty-msg">No projects graded yet</div>
        @endforelse
      </div>
    </div>

    <!-- All Projects -->
    <div class="section-card">
      <div class="section-header">📚 All Projects</div>
      @forelse ($projects as $project)
        @php
          $statusClass = match ($project->status) {
            'submitted' => 'status-green',
            'needs_work' => 'status-orange',
            default => 'status-gray'
          };
          $statusText = match ($project->status) {
            'submitted' => 'Submitted',
            'needs_work' => 'Needs Work',
            default => 'Pending'
          };
        @endphp
        <div class="project-item">
          <div style="flex: 1;">
            <div class="project-name">{{ $project->project_name }}</div>
            <div class="project-meta">{{ $project->course->course_name ?? 'N/A' }} •
              {{ $project->admin->full_name ?? 'N/A' }}</div>
          </div>
          <div style="display: flex; align-items: center; gap: 1rem;">
            <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
            @if($project->grade !== null)
              <span style="font-weight: 600; color: #6366f1;">{{ $project->grade }}/100</span>
            @else
              <span style="color: #9ca3af;">—</span>
            @endif
            <a href="{{ route('doctor.project', $project->project_id) }}" class="btn btn-outline btn-sm">View</a>
          </div>
        </div>
      @empty
        <div class="empty-msg">No projects yet</div>
      @endforelse
    </div>
  </div>
@endsection