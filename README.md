# 📝 Student Grade Management System (sistema-de-notas)

This project is a web system designed for the administration and control of student grades and academic records. It allows for the management of students, registration of grades by subject/period, and performs standard CRUD (Create, Read, Update, Delete) operations.

## 👤 Author
- Jorge Eduardo Treminio Cruz
- 📧 Email: eduardotreminio10@gmail.com
- Linkedln: https://www.linkedin.com/in/eduardo-treminio-b02b81323/
---

## ✨ Key Features

The system is built to handle the following core functionalities:

### 🔑 User Authentication
- Secure login module (`index.php`, `login_post.php`).

### 👨‍🎓 Student Management (CRUD)
- Register new students.
- View and list all students (`listadoalumnos.view.php`).
- Edit student data (`alumnoedit.view.php`).
- Delete student records (`alumnodelete.php`).

### 📝 Grade Management (CRUD)
- Register and assign grades to students (`notas.view.php`, `procesarnota.php`).
- Consult and list all registered grades (`listadonotas.view.php`).
- Delete grade entries (`notadelete.php`).

### 📊 Academic Results
- Module to display and calculate academic results (`resultados.php`).

---

## 💻 Tech Stack

The system is developed using a traditional web architecture:

| Category  | Technology              | Description                                                                 |
|-----------|-------------------------|-----------------------------------------------------------------------------|
| Backend   | PHP                     | Main programming language for business logic and database interaction (92.5%). |
| Frontend  | HTML5, CSS3, JavaScript | Structure, styles, and handling of user interface interactivity.             |
| Database  | MySQL / MariaDB         | Relational database system used to store student and grade information (scripts in the `BD` folder). |

---

## 🚀 Installation and Setup

Follow these steps to get the project running on your local machine.

### ✅ Prerequisites

You need a local web server environment like **XAMPP, WAMP, or MAMP** installed, which includes:

- Apache Web Server.
- PHP (Version 7.x or higher is recommended).
- MySQL / MariaDB Database.

---

### 1. Clone the Repository

Open your terminal and clone the project into your web server's root directory (`htdocs` for XAMPP, `www` for WAMP):

2. Database Configuration

Open phpMyAdmin or your preferred database management tool.
Create a new database (e.g., notas_db).
Import the SQL script located inside the BD/ folder. This script will create all the necessary tables and initial data.

3. Connection Setup

Navigate to the conn/ folder in the project.
Open the connection file (likely named conexion.php or similar).
Update the database credentials to match your local environment:

// Example connection configuration to update:
$host = "localhost";
$user = "root";       // Change if you use a different user
$password = "";       // Change if you have a password set
$database = "your_db_name"; // Must match the name you created in step 2


4. Run the Application

Ensure that your Apache and MySQL services are running.
Open your web browser and navigate to the project URL:
```bash
http://localhost/sistema-de-notas

