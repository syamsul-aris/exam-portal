<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 🎓 Laravel Online Examination System

A web-based examination management system built with **Laravel 11**, designed for **students and lecturers**.  
This system supports timed exams, auto-grading for MCQ, manual grading for subjective questions, and role-based access control.

---

## 🚀 Features

### 👨‍🎓 Student Module
- View available exams based on class enrollment
- Start exam with confirmation modal
- Automatic exam timer with countdown
- Auto-submit when time expires
- Answer MCQ and subjective questions
- View results **only after lecturer grading**
- Exam status tracking:
  - Not Started
  - In Progress
  - Submitted (Pending Grade)
  - Graded

---

### 👨‍🏫 Lecturer Module
- Create and manage exams
- Assign exams to classes
- Set exam duration (minutes)
- Add questions:
  - MCQ (auto-graded)
  - Subjective/Text (manual grading)
- View student submissions
- Grade subjective answers
- Publish final scores

---

## ⏱ Exam Workflow

1. Student starts exam → timer begins
2. Exam auto-locks after duration ends
3. MCQ answers auto-graded
4. Lecturer grades subjective answers
5. Results released to students

---

## 🛠 Tech Stack

| Technology | Usage |
|----------|------|
| Laravel 11 | Backend Framework |
| PHP 8.2 | Server-side language |
| MySQL | Database |
| Blade | Templating Engine |
| Tailwind CSS | UI Styling |
| Alpine.js | UI Interactions |
| Auth (Laravel) | Authentication |

---

## 🧱 Database Tables

- `exams`
- `questions`
- `exam_attempts`
- `exam_answers`
- `class_rooms`
- `users`

---

## 🔐 Access Control

| Role | Permission |
|----|----|
| Student | Take exam, submit answers, view results |
| Lecturer | Create exams, grade answers, publish results |

Students **cannot view results** until lecturer completes grading.

---

## ⚙️ Installation

1️⃣ Clone Repository
`git clone https://github.com/syamsul-aris/exam-portal.git`
`cd exam-portal`

2️⃣ Install Dependencies
`composer install`
`npm install && npm run build`

3️⃣ Environment Setup
`cp .env.example .env`
`php artisan key:generate`
Update .env with your database credentials.

4️⃣ Migrate Database
`php artisan db:seed` 

5️⃣ Run Server
`php artisan serve`
http://127.0.0.1:8000

<!-- ## 🧪 Test Accounts (Seeder)
|Role |	Email |	Password |
|----|----|-----|
|Lecturer |	lecturer@email.com |	Zaqwsx@123 |
|Student |	student@email.com |	Zaqwsx@123 | -->

## 📌 Key Highlights
- Secure exam attempt handling
- Server-side time validation
- Auto + manual grading hybrid system
- Transaction-safe submissions
- Clean MVC architecture

## 📈 Future Enhancements
- Exam analytics & reports
- Question randomization
- Exam retry policy
- Export results (PDF/Excel)
- Notification system

## Author

### Syamsul Aris
- Full Stack Developer (Laravel & React)
- 📧 Email: syamsularis98@gmail.com
- 🔗 GitHub: https://github.com/syamsul-aris

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
