# 📚 Library Management System with Payment Gateway

A web-based Library Management System built using CodeIgniter 4, designed to manage book circulation, user roles, and financial transactions with integrated payment gateway support.

---

## 🚀 Features

### 📖 Library System
- Book management (CRUD)
- Category & search system
- Stock tracking

### 👥 User Management
- Multi-role authentication (Admin, Staff, Member)
- Role-based access control (RBAC)

### 🔄 Circulation
- Borrowing & returning books
- Automatic fine calculation
- Transaction history

### 💳 Payment Gateway Integration
- Digital payment for fines
- Transaction status tracking (Pending, Success, Failed)
- Payment simulation support
- Callback/Webhook handling

---

## 💳 Payment Flow

1. User initiates transaction  
2. System generates payment request  
3. User completes payment  
4. Gateway sends callback  
5. System updates transaction status automatically  

---

## 🛠️ Tech Stack

- PHP 8+
- CodeIgniter 4
- MySQL
- Bootstrap
- REST API (Payment Gateway)

---

## ⚙️ Installation

```bash
git clone https://github.com/username/perpus.git
cd perpus
composer install
cp env .env
php spark serve
