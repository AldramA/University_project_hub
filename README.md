# University Project Hub 🎓

A web-based platform for managing university projects, built with **Laravel 12**. The system facilitates collaboration between students and doctors (faculty members) in managing academic projects.

---

## 📋 Features

### For Students

- **Registration & Login** - Create an account and securely access the platform
- **Home Dashboard** - View available projects and courses
- **Create Projects** - Start new academic projects
- **Join Projects** - Request to join existing projects
- **Project Page** - View project details, team members, and comments
- **Profile Management** - View and manage student profile

### For Doctors (Faculty)

- **Dashboard** - Overview of supervised projects
- **Project Management** - Monitor and manage student projects
- **Grading System** - Evaluate student projects

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Blade Templates, Vite
- **Database:** MySQL
- **Authentication:** Laravel Guards (multi-auth for students & doctors)

---

## 📦 Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone <repository-url>
cd University_project_hub
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup

```bash
# Create SQLite database (if using SQLite)
touch database/database.sqlite

# Run migrations
php artisan migrate
```

### 5. Build Frontend Assets

```bash
npm run build
```

---

## ▶️ Running the Application

### Development Mode (Recommended)

Run the development server with hot reloading:

```bash
composer dev
```

This command runs the following services concurrently:

- Laravel development server
- Queue listener
- Laravel Pail (real-time logs)
- Vite development server

### Manual Start

Alternatively, run each service separately:

```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite (Frontend)
npm run dev
```

The application will be available at: **http://localhost:8000**

---

## 🐳 Docker Setup (Optional)

Run with Docker Compose:

```bash
docker-compose up -d
```

---

## 📁 Project Structure

```
University_project_hub/
├── app/
│   ├── Http/Controllers/
│   │   ├── CommonController.php     # Shared auth logic
│   │   ├── DoctorController.php     # Doctor routes
│   │   ├── StudentController.php    # Student routes
│   │   ├── ProjectsController.php   # Project management
│   │   └── CourseController.php     # Course management
│   └── Models/
├── resources/views/
│   ├── student/                     # Student views
│   ├── doctor/                      # Doctor views
│   ├── layouts/                     # Shared layouts
│   ├── login.blade.php
│   └── welcome.blade.php
├── routes/
│   └── web.php                      # Web routes
└── database/
    └── migrations/                  # Database migrations
```

---

## 🔗 Main Routes

| Route               | Description          | Access  |
| ------------------- | -------------------- | ------- |
| `/`                 | Welcome page         | Public  |
| `/login`            | Login page           | Public  |
| `/register`         | Student registration | Public  |
| `/student/home`     | Student dashboard    | Student |
| `/student/profile`  | Student profile      | Student |
| `/student/project`  | Project details      | Student |
| `/doctor/home`      | Doctor home          | Doctor  |
| `/doctor/dashboard` | Doctor dashboard     | Doctor  |

---

## 🧪 Testing

```bash
composer test
```

