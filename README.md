# TRIV Design & Construction Firm Website

A dynamic and responsive website for **TRIV: Design & Construction Firm**, built using **PHP** and supporting full backend functionality with admin and client portals.

## 🛠️ Setup Instructions
### 📦 1. Import the Database
Start XAMPP and ensure Apache and MySQL services are running.

Open phpMyAdmin (http://localhost/phpmyadmin).

Create a new database named: triv_db.

Import the provided SQL file:

Click on the triv_db database.

Go to the Import tab.

Upload and execute triv_db.sql.

### 🔐 2. Admin Login Credentials
The seed data in `triv_db.sql` ships with a default admin account
(`admin@triv.com`). **Change its password immediately after importing** —
especially before deploying anywhere public:

```sql
UPDATE users
SET password = '<output of PHP password_hash()>'
WHERE email = 'admin@triv.com';
```

```bash
php -r "echo password_hash('your-new-password', PASSWORD_DEFAULT);"
```


### 🌐 3. Run the Application
Place the project folder inside the htdocs directory of XAMPP.

Access the website via your browser at:
http://localhost/your-folder-name/


## 🚀 Features

### ✅ Frontend (Client Portal)
- Clean and responsive user interface.
- Clients can:
  - Submit inquiries.
  - View status updates on their submitted inquiries.
  - Browse company information, services, team, and projects.

### 🔐 Backend (Admin Panel)
Admin users have access to a secure dashboard where they can perform full **CRUD** operations:

#### 👥 Manage Users
- Create, Read, Update, and Delete user accounts.
- Control user access to the system.

#### 💼 Manage Jobs and Applications
- Post, update, or remove job listings.
- View and manage applications submitted by users.

#### 📨 Manage Inquiries
- View and respond to client inquiries.
- Track inquiry statuses.

#### 🛠 Manage Site Content
- **Team**: Add or remove team members.
- **Developers**: Manage the list of developers.
- **Projects**: Full CRUD for showcasing completed or ongoing projects.
- **Services**: Manage services offered by the firm.

## 🧠 Object-Oriented Programming (OOP)
The project implements core OOP principles in PHP to ensure maintainability and scalability:

- **Abstraction**: Database and authorization logic are abstracted into reusable and easily extendable classes.
- **Encapsulation**: Sensitive data (e.g., credentials, session tokens) and critical logic are encapsulated within private/protected methods and accessed via controlled interfaces.

This structure provides better security, cleaner code, and a modular architecture.

## ☁️ Deployment
See **[DEPLOY.md](DEPLOY.md)** for hosting this on Render, Railway, or any
Docker host, including the free-tier MySQL setup. Database credentials are
read from environment variables (`DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`,
`DB_PASS`, `DB_SSL`) and fall back to XAMPP defaults when unset — see
`.env.example`.

## ⚙️ Technology Stack
- **PHP** (OOP, backend logic)
- **MySQL** (Database management)
- **HTML/CSS/JS** (Frontend structure and interactivity)
- **XAMPP** (Local development and testing)
- **Git/GitHub** (Version control)

## 🔐 Authentication
- Session-based login system for admin access.
- Secured pages only accessible after authentication.
- User roles and access management handled via OOP-based logic.

