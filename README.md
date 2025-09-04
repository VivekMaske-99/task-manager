📝 Task Manager (Core PHP + MySQL + Bootstrap 5)

A simple Task Manager web application built using Core PHP, MySQL, and Bootstrap 5.
It allows users to register, log in, and manage their tasks with CRUD operations.
Includes a modern UI with Light/Dark mode toggle.

🚀 Features

🔑 User Authentication – Register, Login, Logout (secure password hashing)

✅ Task Management (CRUD) – Add, Edit, Delete, and Mark tasks as Done

🎨 Modern UI – Responsive design using Bootstrap 5

🌙 Dark/Light Mode Toggle – Saves user preference with localStorage

🔒 User-Specific Data – Each user sees only their own tasks

🛠️ Tech Stack

Frontend: HTML, CSS, Bootstrap 5

Backend: Core PHP (no framework)

Database: MySQL (phpMyAdmin for management)

Server: Apache (XAMPP for local, deployable on any PHP hosting)

📂 Project Structure
task-manager/
│-- config.php        # Database connection
│-- register.php      # User registration
│-- login.php         # User login
│-- logout.php        # User logout
│-- index.php         # Dashboard (task list)
│-- add_task.php      # Add new task
│-- edit_task.php     # Edit task
│-- delete_task.php   # Delete task
│-- mark_done.php     # Mark task as done

⚡ Setup Instructions

Clone repo into your XAMPP htdocs folder:

git clone https://github.com/your-username/task-manager.git


Create a database task_manager in phpMyAdmin.

Run this SQL:

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  status ENUM('Pending','Done') DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


Update config.php if needed:

$host = "localhost";
$user = "root";
$pass = "";
$db   = "task_manager";


Start Apache + MySQL in XAMPP.

Open in browser:

http://localhost/task-manager/

📸 Screenshots

Login Page

Register Page

Dashboard with Tasks (Light & Dark mode)

(You can add screenshots later by uploading images in GitHub repo and linking them.)

📌 Future Improvements

Add user profile page

Task categories/labels

Due dates & reminders

Export tasks as CSV/PDF

👨‍💻 Author

Vivek Maske
📧 Email: vivekmaske998@gmail.com

🔗 LinkedIn
 | GitHub
