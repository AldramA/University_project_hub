@if ($projects->isEmpty())
    <p class="text-center" style="font-weight: bold; color: red; font-size: 20px; margin-top: 20px">No results found</p>
@else
    @foreach ($projects as $project)
      <div class="card">
        <div class="flex justify-between items-center mb-sm">
          <h3 style="font-weight: bold">{{ $project->project_name }}</h3>
          <span class="badge badge-success">Open</span>
        </div>
        <p class="text-secondary small mb-sm">Admin: Sara Ali</p>
        <p class="text-secondary small mb-md">Members: 2/4</p>
        <button class="btn btn-primary btn-block">Request to Join</button>
      </div>
    @endforeach
@endif
