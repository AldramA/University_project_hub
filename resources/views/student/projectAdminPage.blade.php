@extends('layouts.mainStudent')

@section('content')

    <div class="container">
      <div class="flex justify-between items-center mb-lg">
        <h1 class="page-title">Warehouse Management System (Admin View)</h1>
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
              efficient tracking of assets and stock levels.
            </p>
          </div>

          <div class="card mb-md">
            <h2 class="section-title">Project Settings</h2>
            <form>
              <div class="form-group">
                <label class="form-label">Project Link (GitHub / Drive)</label>
                <div class="flex gap-sm">
                  <input
                    type="url"
                    class="form-input"
                    value="https://github.com/example/warehouse-system"
                    placeholder="https://..."
                  />
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>
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
            </ul>
          </div>

          <div class="card mb-md">
            <h2 class="section-title">Actions</h2>
            <a href="Portfolio.html" class="btn btn-outline btn-block mb-sm"
              >Edit Portfolio</a
            >
            <a href="ProjectPage.html" class="btn btn-outline btn-block"
              >View as Member</a
            >
          </div>
                    <div class="card">
            <h2 class="section-title">Join Requests</h2>
            <div
              class="p-md border rounded"
              style="
                border: 1px solid var(--border-color);
                border-radius: var(--radius-md);
              "
            >
              <div class="flex justify-between items-center">
                <div>
                  <strong>Ahmed Abdullah</strong>
                  <p
                    class="text-secondary"
                    style="font-size: var(--font-size-sm)"
                  >
                    Second Year
                  </p>
                </div>
                <div class="flex gap-sm">
                  <button class="btn btn-primary btn-sm">Accept</button>
                  <button class="btn btn-danger btn-sm">Reject</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
