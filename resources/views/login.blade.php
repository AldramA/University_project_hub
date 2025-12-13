<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Doctor Login - University Project Hub</title>
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <style>
    /* Doctor Login Specific Styles */
    .doctor-badge {
      display: inline-flex;
      align-items: center;
      gap: var(--spacing-sm);
      background: linear-gradient(135deg, var(--primary-color), #6366f1);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: var(--radius-full);
      font-size: var(--font-size-sm);
      font-weight: var(--font-weight-medium);
      margin-bottom: var(--spacing-lg);
    }

    .doctor-badge svg {
      width: 20px;
      height: 20px;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .logo-section {
      text-align: center;
      margin-bottom: var(--spacing-xl);
    }

    .logo-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--primary-color), #818cf8);
      border-radius: var(--radius-lg);
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto var(--spacing-md);
      box-shadow: var(--shadow-lg);
    }

    .logo-icon svg {
      width: 40px;
      height: 40px;
      color: white;
    }

    .form-input-icon {
      position: relative;
    }

    .form-input-icon input {
      padding-left: 2.5rem;
    }

    .form-input-icon svg {
      position: absolute;
      left: 0.75rem;
      top: 50%;
      transform: translateY(-50%);
      width: 20px;
      height: 20px;
      color: var(--text-secondary);
    }

    .remember-forgot {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: var(--spacing-lg);
      font-size: var(--font-size-sm);
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: var(--spacing-sm);
      cursor: pointer;
    }

    .remember-me input {
      width: 16px;
      height: 16px;
      accent-color: var(--primary-color);
    }

    .forgot-link {
      color: var(--primary-color);
      font-weight: var(--font-weight-medium);
    }

    .forgot-link:hover {
      text-decoration: underline;
    }

    .divider {
      display: flex;
      align-items: center;
      gap: var(--spacing-md);
      margin: var(--spacing-lg) 0;
      color: var(--text-secondary);
      font-size: var(--font-size-sm);
    }

    .divider::before,
    .divider::after {
      content: "";
      flex: 1;
      height: 1px;
      background-color: var(--border-color);
    }

    .student-login-link {
      text-align: center;
      padding-top: var(--spacing-md);
      border-top: 1px solid var(--border-color);
    }

    .btn-login {
      background: linear-gradient(135deg, var(--primary-color), #6366f1);
      border: none;
      font-size: var(--font-size-base);
      padding: 0.75rem 1.5rem;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: var(--shadow-lg);
    }
  </style>
</head>

<body>
  @if (session('error'))
    <div class="alert alert-danger">
      {{ session('error') }}
    </div>
  @endif
  <div class="auth-container">
    <div class="card login-card">
      <!-- Logo Section -->
      <div class="logo-section">
        <div class="logo-icon">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
        </div>
        <h1 class="page-title">University Project Hub</h1>
        <span class="doctor-badge">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
          </svg>
          Faculty Portal
        </span>
      </div>

      <!-- Login Form -->
      <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group">
          <label class="form-label">University Email</label>
          <div class="form-input-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <input name="email" type="email" class="form-input" placeholder="user@university.edu" required />
          </div>
        </div>

        <div class="form-group">
          <label class="form-label">Password</label>
          <div class="form-input-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            <input name="password" type="password" class="form-input" placeholder="••••••••" required />
          </div>
        </div>

        <div class="remember-forgot">
          <label class="remember-me">
            <input type="checkbox" />
            <span>Remember me</span>
          </label>
          <a href="#" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary btn-block btn-login">
          Sign In
        </button>
      </form>
      <p style="margin-top: 20px; margin-bottom: 20px;" class="text-center">
        Don't have an account? <a href="{{ route('register') }}">Register</a>
      </p>
    </div>
  </div>
</body>

</html>
