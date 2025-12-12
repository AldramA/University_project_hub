@extends('layouts.mainStudent')
@section('title', 'Join Project')
@section('content')

  <div class="container">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <h1 class="page-title mb-lg">Join a Project</h1>

    <!-- Search Section -->
    <div class="card mb-lg">
      <div class="flex gap-sm">
        <form action="{{ route('student.project-search') }}" method="post">
          @csrf
          <input name="search" type="text" class="form-input" placeholder="Search for projects..." style="flex: 1" />
          <button type="submit" class="btn btn-primary">Search</button>
        </form>
      </div>
    </div>

    <!-- Results -->
    <h2 class="section-title">Available Projects</h2>

    <div class="grid md:grid-cols-2 gap-md">
      <iframe name="resultsFrame" style="width:100%; height:400px; border:0;"></iframe>
    </div>
  </div>

@endsection
