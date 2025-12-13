<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>University Project Hub</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .container {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 30px;
      padding: 60px 50px;
      max-width: 800px;
      width: 100%;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      text-align: center;
      animation: fadeIn 0.8s ease-in;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .logo {
      width: 100px;
      height: 100px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 50%;
      margin: 0 auto 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 48px;
      color: white;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    h1 {
      font-size: 42px;
      color: #333;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .subtitle {
      font-size: 20px;
      color: #666;
      margin-bottom: 40px;
      line-height: 1.6;
    }

    .features {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 25px;
      margin: 40px 0;
    }

    .feature-card {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      padding: 30px 20px;
      border-radius: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .feature-icon {
      font-size: 40px;
      margin-bottom: 15px;
    }

    .feature-title {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 10px;
    }

    .feature-desc {
      font-size: 14px;
      color: #666;
    }

    .cta-buttons {
      display: flex;
      gap: 20px;
      justify-content: center;
      margin-top: 40px;
      flex-wrap: wrap;
    }

    .btn {
      padding: 16px 40px;
      border: none;
      border-radius: 50px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(102, 126, 234, 0.6);
    }

    .btn-secondary {
      background: white;
      color: #667eea;
      border: 2px solid #667eea;
    }

    .btn-secondary:hover {
      background: #667eea;
      color: white;
      transform: translateY(-3px);
    }

    @media (max-width: 600px) {
      .container {
        padding: 40px 30px;
      }

      h1 {
        font-size: 32px;
      }

      .subtitle {
        font-size: 18px;
      }

      .cta-buttons {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="logo">🎓</div>
    <h1>University Project Hub</h1>
    <p class="subtitle">Your gateway to collaborative learning and innovation. Connect with peers, discover exciting
      projects, and bring your ideas to life.</p>

    <div class="features">
      <div class="feature-card">
        <div class="feature-icon">🔍</div>
        <div class="feature-title">Discover Projects</div>
        <div class="feature-desc">Browse hundreds of innovative projects from students across all departments</div>
      </div>

      <div class="feature-card">
        <div class="feature-icon">👥</div>
        <div class="feature-title">Join Teams</div>
        <div class="feature-desc">Connect with talented students and contribute to meaningful projects</div>
      </div>

      <div class="feature-card">
        <div class="feature-icon">✨</div>
        <div class="feature-title">Create Your Own</div>
        <div class="feature-desc">Launch your project idea and build a team of passionate collaborators</div>
      </div>
    </div>

    <div class="cta-buttons">
      <button class="btn btn-primary" onclick="window.location.href = '{{ route('login') }}'">Login</button>
      <button class="btn btn-secondary" onclick="window.location.href = '{{ route('register') }}'">Register</button>
    </div>
  </div>
</body>

</html>
