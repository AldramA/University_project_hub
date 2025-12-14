# University Project Hub 🎓

A web-based platform for managing university projects, built with **Laravel 12**. Students can create/join projects, and doctors can supervise, grade, and provide feedback.

---

## 🚀 Quick Start

### Prerequisites

- PHP 8.2+
- Composer
- MySQL

### Installation

```bash
# 1. Clone and enter directory
git clone <repository-url>
cd University_project_hub

# 2. Install dependencies
composer install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=university_project_hub
DB_USERNAME=root
DB_PASSWORD=your_password

# 5. Create database and run migrations
php artisan migrate

# 6. Start server
php artisan serve
```

Open **http://localhost:8000** in your browser.

---

## 📋 Features

### Students

- Register & Login
- Create new projects
- Join existing projects (requires admin approval)
- View project details, team members, and doctor comments
- See grades and feedback

### Doctors

- View supervised projects
- Update project status (Not Graded Yet / Submitted / Needs More Work)
- Grade projects (0-100)
- Add comments and feedback

---

## 🔗 Main Routes

| Route                     | Description            | Access  |
| ------------------------- | ---------------------- | ------- |
| `/`                       | Welcome page           | Public  |
| `/login`                  | Login page             | Public  |
| `/register`               | Student registration   | Public  |
| `/student/home`           | Student dashboard      | Student |
| `/student/create-project` | Create new project     | Student |
| `/student/join-project`   | Search & join projects | Student |
| `/student/project/{id}`   | Project details        | Student |
| `/doctor/home`            | Doctor home            | Doctor  |
| `/doctor/project/{id}`    | Project management     | Doctor  |

---

## 📁 Project Structure

```
app/
├── Http/Controllers/
│   ├── CommonController.php      # Authentication
│   ├── StudentController.php     # Student logic
│   ├── DoctorController.php      # Doctor logic
│   └── ProjectsController.php    # Project CRUD & grading
├── Models/
│   ├── Student.php
│   ├── Doctor.php
│   ├── Project.php
│   ├── ProjectMember.php
│   ├── JoinRequest.php
│   ├── Course.php
│   └── Comment.php
resources/views/
├── student/          # Student views
├── doctor/           # Doctor views
└── layouts/          # Shared layouts
```

---

## 🐳 Docker (Optional)

```bash
docker-compose up -d
```

---

## 🧪 Testing

```bash
php artisan test
```
