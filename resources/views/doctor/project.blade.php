@extends('layouts.mainDoctor')

@section('content')
    <div class="container">
      <div class="flex justify-between items-center mb-lg">
        <h1 class="page-title">Warehouse Management System</h1>
        <a href="DoctorHome.html" class="btn btn-outline">Back</a>
      </div>

      <div class="grid md:grid-cols-3 gap-lg">
        <!-- Main Content -->
        <div style="grid-column: span 2">
          <div class="card mb-md">
            <h2 class="section-title">Project Details</h2>
            <p class="text-secondary mb-md">
              Building a web system for university inventory management and
              efficient tracking of assets and stock levels.
            </p>
            <div
              class="flex items-center gap-sm p-sm bg-gray-50 rounded"
              style="
                background-color: var(--background-color);
                border-radius: var(--radius-md);
              "
            >
              <span class="text-secondary">Project Link:</span>
              <a href="#" target="_blank" style="text-decoration: underline"
                >github.com/example/warehouse-system</a
              >
            </div>
          </div>

          <div class="card mb-md">
            <h2 class="section-title">Add Comment</h2>
            <form>
              <div class="form-group">
                <textarea
                  class="form-textarea"
                  rows="4"
                  placeholder="Write your notes for the team here..."
                ></textarea>
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
                <div
                  style="
                    width: 32px;
                    height: 32px;
                    background-color: var(--primary-color);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 12px;
                  "
                >
                  MS
                </div>
                <div>
                  <div style="font-weight: bold">Mohamed Sobhy</div>
                  <span class="badge badge-success" style="font-size: 0.7rem"
                    >Admin</span
                  >
                </div>
              </li>
              <li class="flex items-center gap-sm">
                <div
                  style="
                    width: 32px;
                    height: 32px;
                    background-color: var(--secondary-color);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 12px;
                  "
                >
                  AH
                </div>
                <div>Ahmed Hassan</div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
@endsection
