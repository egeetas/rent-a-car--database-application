# 🚗 Rent-A-Car Database Web Application

This is a full-stack vehicle rental application developed as a database course project. It integrates both **SQL (MySQL)** and **NoSQL (MongoDB)** systems via **PHP**, and offers user and admin interfaces for managing the rental process.

## 📌 Project Overview

The application includes:

- A **MySQL-based relational database** managing users, vehicles, rentals, payments, maintenance logs, reviews, and insurance.
- A **MongoDB-based support ticket system** for NoSQL integration.
- A **web-based frontend** developed using plain PHP and HTML (no external CSS frameworks used).
- **phpMyAdmin** for MySQL database administration.

## 🗂️ Technologies Used

| Layer | Technologies |
|-------|--------------|
| Backend | PHP, MySQL, MongoDB |
| Database Tools | phpMyAdmin (MySQL), MongoDB Atlas |
| Web Server | XAMPP (Apache + MySQL) |
| Frontend | HTML + PHP |

## 📦 Features

### ✅ MySQL (Relational Side)
- Vehicle listing and filtering
- User registration and login
- Booking system (pickup/return date, location, pricing)
- Payment processing (via stored procedure)
- Maintenance tracking (via triggers)
- Reviews and ratings (stored procedure)
- Insurance plan selection
- Admin panel for vehicle and user management

### 🟣 MongoDB (NoSQL Side)
- Support ticket system:
  - Users can submit issues (e.g., vehicle problems, delays)
  - Admins can respond and close tickets

