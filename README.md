# Student Management System (CRUD)

A simple web application for managing student records. This project demonstrates basic CRUD (Create, Read, Update, Delete) operations using PHP and MySQL. It also includes additional functionalities such as search, pagination, sorting, and bulk operations.

## Table of Contents

- [Overview](#overview)
- [Key Features](#key-features)
- [Technologies Used](#technologies-used)
- [Setup and Installation](#setup-and-installation)
- [Usage](#usage)
- [File Structure](#file-structure)
- [Database Schema](#database-schema)

## Overview

This project is a student management system that allows users to manage student records. The system supports adding new students, viewing all students, editing and deleting student details, searching students by name, and more. It's a great way to learn and practice web development using PHP and MySQL.

## Key Features

- Add new student records
- View all student records
- Edit and update student details
- Delete individual student records
- Search for students by name
- Pagination to manage large datasets
- Sort students by name, age, or grade
- Bulk delete multiple student records
- Data validation to ensure the accuracy of entries

## Technologies Used

- **Front-end**: HTML, CSS
- **Back-end**: PHP
- **Database**: MySQL

## Setup and Installation

To set up and run this project locally, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/student-management-system.git
   ```
2. Move into the project directory:

   ```bash
   cd student-management-system
   ```

3. Set up the MySQL database:

   - Create a database named `student_management`.
   - Create the students table using the following query:

   ```bash
   CREATE TABLE students (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(100) NOT NULL,
       age INT NOT NULL,
       grade VARCHAR(50) NOT NULL
   );
   ```

4. Start your local server using XAMPP or any PHP server, and navigate to http://localhost/student-management-system in your browser.

## Usage

Once the application is set up, you can:

- **Add a new student**: Fill out the form to add a student's name, age, and grade.
- **View all students**: See a list of all students with options to edit or delete each record.
- **Edit a student**: Modify an existing student's information.
- **Delete a student**: Remove a student from the database.
- **Search**: Use the search bar to find students by their name.
- **Bulk delete**: Select multiple students and delete them in one operation.

## File Structure

```plaintext
.
├── add_student.php          # Form for adding new students
├── bulk_delete.php          # Handles bulk deletion of students
├── config.php               # Database connection file
├── database_connection.php  # Database connection handler
├── delete_student.php       # Deletes a specific student
├── edit_student.php         # Form for editing student details
├── index.php                # Main page that lists all students
├── view_student.php         # Page to view a student's details
├── css/
│   ├── styles.css           # Main styling for the application
│   ├── styles_add.css       # Styling for add and edit forms
│   └── style_view.css       # Styling for viewing student details
```

## Database Schema

To set up the database, run the following queries:

```bash
CREATE DATABASE student_management;

    CREATE TABLE students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        age INT NOT NULL,
        grade VARCHAR(50) NOT NULL
    );
```
