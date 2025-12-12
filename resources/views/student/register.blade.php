<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - University Project Hub</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>

<body>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

  <div class="auth-container">
    <div class="card" style="width: 100%; max-width: 500px">
      <h1 class="page-title text-center mb-md" style="text-align: center">
        Create Account
      </h1>
      <p class="text-secondary text-center mb-lg" style="text-align: center">
        Enter your details to register
      </p>

      <form action="/register" method="POST">
        @csrf
        <div class="form-group">
          <label class="form-label">Full Name</label>
          <input name="full_name" type="text" class="form-input" placeholder="Enter your full name" required />
        </div>

        <div class="form-group">
          <label class="form-label">Email</label>
          <input name="email" type="email" class="form-input" placeholder="example@student.edu.eg" required />
        </div>

        <div class="form-group">
          <label class="form-label">Mobile Number (Optional)</label>
          <input name="phone" type="tel" class="form-input" placeholder="01xxxxxxxxx" />
        </div>

        <div class="grid grid-cols-2 gap-md">
          <div class="form-group">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-input" placeholder="********" required />
          </div>
          <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input name="password_confirmation" type="password" class="form-input" placeholder="********" required />
          </div>
        </div>

        <div class="grid grid-cols-2 gap-md">
          <div class="form-group">
            <label class="form-label">Year</label>
            <select name="year" class="form-select" required>
              <option value="">Select Year</option>
              <option value="1">First Year</option>
              <option value="2">Second Year</option>
              <option value="3">Third Year</option>
              <option value="4">Fourth Year</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Department</label>
            <select name="department" class="form-select" required>
              <option value="">Select Department</option>
              <option value="cs">Computer Science (CS)</option>
              <option value="is">Information Systems (IS)</option>
              <option value="it">Information Technology (IT)</option>
              <option value="ai">Artificial Intelligence (AI)</option>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-md">
          Create Account
        </button>
      </form>

      <div class="text-center mt-md" style="text-align: center">
        <p class="text-secondary" style="font-size: var(--font-size-sm)">
          Already have an account? <a href="{{ route('login') }}">Login</a>
        </p>
      </div>
    </div>
  </div>
</body>

</html>
