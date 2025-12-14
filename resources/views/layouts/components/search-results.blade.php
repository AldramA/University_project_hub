<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@if ($projects->isEmpty())
  <p class="text-center" style="font-weight: bold; color: red; font-size: 20px; margin-top: 20px">
    No results found
  </p>
@else
  <div class="grid md:grid-cols-2 gap-md">
    @foreach ($projects as $project)
      <div class="card">
        <div class="flex justify-between items-center mb-sm">
          <h3 style="font-weight: bold">
            {{ $project->project_name }}
          </h3>
          <span class="badge badge-success">{{ ucfirst($project->status) }}</span>
        </div>

        <p class="text-secondary small mb-sm">
          Admin: {{ $project->admin->full_name ?? 'Unknown' }}
        </p>

        <p class="text-secondary small mb-md">
          Members: {{ $project->members->count() }}/4
        </p>

        <form action="{{ route('student.request-join-project', ['id' => $project->project_id]) }}" method="POST"
          target="_top">
          @csrf
          <button type="submit" class="btn btn-primary btn-block join-btn">
            Join Project
          </button>
        </form>
      </div>
    @endforeach
  </div>
@endif

<style>
  .join-btn {
    transition: all 0.2s ease;
  }

  .join-btn:active {
    transform: scale(0.95);
    background-color: #2563eb;
  }
</style>
