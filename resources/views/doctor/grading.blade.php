<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grading - University Project Hub</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar">
      <div class="container navbar-content">
        <a href="DoctorHome.html" class="navbar-brand">Project Hub (Doctor)</a>
        <div class="navbar-nav">
          <a href="DoctorHome.html" class="nav-link">Home</a>
          <a href="DoctorDashboard.html" class="nav-link">Dashboard</a>
          <a
            href="Login.html"
            class="nav-link"
            style="color: var(--danger-color)"
            >Logout</a
          >
        </div>
      </div>
    </nav>

    <div class="container" style="max-width: 600px">
      <div class="flex justify-between items-center mb-lg">
        <h1 class="page-title">Project Grading</h1>
        <a href="DoctorProject.html" class="btn btn-outline">Back</a>
      </div>

      <div class="card">
        <h2 class="section-title mb-md">Warehouse Management System</h2>
        <p class="text-secondary mb-lg">Team: Mohamed Sobhy, Ahmed Hassan</p>

        <form action="DoctorHome.html">
          <div class="form-group">
            <label class="form-label">Final Grade (out of 100)</label>
            <input
              type="number"
              class="form-input"
              placeholder="0"
              min="0"
              max="100"
              required
            />
          </div>

          <div class="form-group">
            <label class="form-label">Final Feedback</label>
            <textarea
              class="form-textarea"
              rows="5"
              placeholder="Write your final evaluation and key notes..."
              required
            ></textarea>
          </div>

          <div
            class="mt-lg pt-md border-t"
            style="border-top: 1px solid var(--border-color)"
          >
            <div class="flex gap-sm">
              <button type="submit" class="btn btn-primary btn-block">
                Save Grade
              </button>
            </div>
            <p class="text-secondary small mt-sm text-center">
              * Once saved, the grade will be visible to students and cannot be
              modified.
            </p>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
