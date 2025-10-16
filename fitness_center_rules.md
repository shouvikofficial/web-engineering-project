
# 🧠 AI Agent Rules File - Fitness Center Management System

**Project Name:** Fitness Center Management System  
**Frontend:** HTML, CSS, JavaScript  
**Backend:** PHP  
**Database:** MySQL  

---

## 1. PROJECT OVERVIEW
Web-based Fitness Center Management System.  
Allows Admins to manage members, trainers, schedules, and payments; members to register, login, and view profile/schedule/payments.

---

## 2. FOLDER STRUCTURE
```
fitness_center/
├── index.html
├── login.html
├── register.html
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── script.js
│   └── images/
├── dashboard/
│   ├── admin-dashboard.php
│   ├── member-dashboard.php
│   ├── view-members.php
│   ├── view-trainers.php
│   └── view-payments.php
├── backend/
│   ├── db.php
│   ├── auth.php
│   ├── register_user.php
│   ├── add_member.php
│   ├── edit_member.php
│   ├── delete_member.php
│   ├── add_trainer.php
│   ├── delete_trainer.php
│   ├── add_schedule.php
│   ├── add_payment.php
│   └── fetch_data.php
├── database/
│   └── fitness_center.sql
└── README.md
```
---

## 3. FRONTEND RULES
- Use HTML, CSS, JS only.  
- Responsive, mobile-friendly UI.  
- Forms must post to backend PHP scripts.  
- JS validation allowed.  

---

## 4. BACKEND RULES
- All backend files must include `db.php`.  
- Use `mysqli` functions.  
- Validate inputs, hash passwords.  
- Use session management for login.  
- Redirect or return success/error messages.

---

## 5. DATABASE DESIGN
Database: `fitness_center`  
Tables: `users`, `members`, `trainers`, `classes`, `payments`.  
Include foreign keys, proper data types, and example INSERTs.

---

## 6. AI AGENT BEHAVIOR RULES
- Understand context: Fitness Center Management System.  
- Keep frontend & backend separate.  
- Comment code clearly, use descriptive variable names.  
- Return appropriate messages for form submissions.  
- Follow folder structure.  

---

## 7. SESSION MANAGEMENT
- Start sessions on login.  
- Use `$_SESSION['user_id']` and `$_SESSION['role']`.  
- Protect admin pages from non-admin access.

---

## 8. FINAL OUTPUT EXPECTATION
- Fully working system with frontend, backend, and database.  
- Admin dashboard with CRUD functionality.  
- Member dashboard with profile & schedule view.  
- Responsive and secure application.
