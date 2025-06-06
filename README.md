# 🧳 Lost & Found Hub

A complete web-based Lost & Found Management System built using **PHP**, **MySQL**, **HTML**, **CSS**, and **JavaScript**. Users can report lost or found items, and admins can verify and match them. 

---

## 📁 Project Structure

lostfound/
│
├── index.php # Home Page
├── login.php # User Login
├── register.php # User Registration
├── dashboard.php # User Dashboard
├── report_lost.php # Report Lost Items
├── report_found.php # Report Found Items
├── item_details.php # View Item Details
│
├── /admin/ # Admin Folder
│ ├── login.php # Admin Login
│ └── dashboard.php # Admin Dashboard
│
├── /css/
│ └── style.css # Global Stylesheet
│
├── /js/
│ └── script.js # JavaScript Functions
│
├── /uploads/ # Uploaded Item Images
│ └── (image files)
│
├── db.php # Database Connection
└── .htaccess # URL Routing Rules


---

## 🗃️ Database Setup

### 1. Create Database
```sql
CREATE DATABASE lost_found;
USE lost_found;


CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    type ENUM('lost', 'found'),
    item_name VARCHAR(100),
    description TEXT,
    color VARCHAR(50),
    size VARCHAR(50),
    image_path VARCHAR(255),
    contact_info VARCHAR(255),
    status ENUM('pending', 'matched') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
