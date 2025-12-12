<!-- Navbar -->
<nav class="navbar">
  <div class="container navbar-content">
    <a href="{{ route('doctor.home', Auth::guard('doctor')->user()->doctor_id) }}" class="navbar-brand">Project Hub (Doctor)</a>
    <div class="navbar-nav">
      <a href="{{ route('doctor.home', Auth::guard('doctor')->user()->doctor_id) }}" class="nav-link active">Home</a>
      <a href="{{ route('doctor.dashboard', Auth::guard('doctor')->user()->doctor_id) }}" class="nav-link">Dashboard</a>
      <a href="{{ route('logout') }}" class="nav-link" style="color: var(--danger-color)">Logout</a>
    </div>
  </div>
</nav>
