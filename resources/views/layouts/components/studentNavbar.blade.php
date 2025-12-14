<!-- Student Navbar -->
<nav class="navbar">
  <div class="container navbar-content">
    <a href="{{ route('student.home') }}" class="navbar-brand">Project Hub</a>
    <div class="navbar-nav">
      <a href="{{ route('student.home') }}" class="nav-link active">Home</a>
      <a href="{{ route('student.profile', Auth::guard('student')->user()->student_id) }}" class="nav-link">Profile</a>
      <a href="{{ route('logout') }}" class="nav-link" style="color: var(--danger-color)">Logout</a>
    </div>
  </div>
</nav>