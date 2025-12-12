@extends('layouts.mainStudent')

@section('content')

    <div class="container">
      <div class="flex justify-between items-center mb-lg">
        <h1 class="page-title">Warehouse Management System</h1>
        <span
          class="badge badge-info"
          style="font-size: 1rem; padding: 0.5rem 1rem"
          >In Progress</span
        >
      </div>

      <div class="grid md:grid-cols-3 gap-lg">
        <!-- Main Content -->
        <div style="grid-column: span 2">
          <div class="card mb-md">
            <h2 class="section-title">Project Description</h2>
            <p class="text-secondary mb-md">
              Building a web system for university inventory management and
              efficient tracking of assets and stock levels. The system aims to
              streamline inventory processes and reduce human error.
            </p>

            <div
              class="flex gap-md mt-md pt-md border-t"
              style="border-top: 1px solid var(--border-color)"
            >
              <div>
                <span
                  class="text-secondary block"
                  style="font-size: var(--font-size-sm)"
                  >Course</span
                >
                <strong>Software Engineering</strong>
              </div>
              <div>
                <span
                  class="text-secondary block"
                  style="font-size: var(--font-size-sm)"
                  >Supervisor</span
                >
                <strong>Dr. Ahmed Ali</strong>
              </div>
            </div>
          </div>

          <div class="card mb-md">
            <h2 class="section-title">Doctor's Comments</h2>
            <div
              class="p-md"
              style="
                background-color: var(--background-color);
                border-radius: var(--radius-md);
              "
            >
              <div class="flex justify-between mb-sm">
                <strong>Dr. Ahmed Ali</strong>
                <span
                  class="text-secondary"
                  style="font-size: var(--font-size-sm)"
                  >2 days ago</span
                >
              </div>
              <p>
                Please clarify the item search interface better in the next
                submission.
              </p>
            </div>
          </div>

          <div class="card">
            <h2 class="section-title">Project Files & Links</h2>
            <div class="flex items-center gap-sm">
              <span class="text-secondary">GitHub Link:</span>
              <a href="#" target="_blank" style="text-decoration: underline"
                >github.com/example/warehouse-system</a
              >
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div>
          <div class="card mb-md">
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
              <li class="flex items-center gap-sm">
                <div
                  style="
                    width: 32px;
                    height: 32px;
                    background-color: var(--accent-color);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-size: 12px;
                  "
                >
                  SA
                </div>
                <div>Sara Ali</div>
              </li>
            </ul>
          </div>

          <div class="card mb-md">
            <h2 class="section-title">Actions</h2>
            <a href="Portfolio.html" class="btn btn-outline btn-block mb-sm"
              >View Portfolio</a
            >
          </div>
        </div>
      </div>
    </div>
@endsection
