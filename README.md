# Task Management System

## Overview
This Task Management System is built using Laravel and provides a robust platform for managing tasks with user authentication, role-based access, CRUD operations, and document upload functionality. The application allows users to create, read, update, and delete tasks while managing their access based on user roles.

## Getting Started

### Prerequisites
Make sure you have the following installed:
- PHP >= 7.3
- Composer
- MySQL or any other database server
- Laravel >= 8.x

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   ```

2. **Navigate to the Application Directory**
   ```bash
   cd Application
   ```

3. **Install Dependencies**
   ```bash
   composer install
   ```

4. **Copy the .env.example to .env**
   ```bash
   cp .env.example .env
   ```

5. **Set Up Your Environment**
   Open the `.env` file and configure your database settings:
   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

7. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

8. **Seed the Database**
   ```bash
   php artisan db:seed
   ```

9. **Serve the Application**
   ```bash
   php artisan serve
   ```

### Login Credentials
- **Email:** admin@mail.com
- **Password:** Admin@123

## Features

### Authentication
The application implements Laravel's authentication system, allowing users to register, log in, and log out. The registration and login forms include JavaScript validations for a better user experience, along with PHP validations on the server side.

### User Roles and Permissions
- Admin: Has access to all functionalities, including viewing, updating, deleting, and creating tasks.
- Manager: Can view and manage tasks assigned to them.
- User: Can only view their own tasks.

The helper function `userCan` is implemented to check user permissions dynamically.

### Task Management
Users can create, read, update, and delete tasks. Each task has the following attributes:
- Title
- Description
- Priority (High, Medium, Low)
- Status (Pending, Completed)
- Deadline

### Document Upload
Users can upload documents related to tasks, which are stored in the `public/Uploads/Tasks` folder. The system supports viewing and downloading documents through the application.

### Dashboard
After logging in, users are redirected to a dashboard that displays:
- The number of pending and completed tasks
- The priority of tasks

### Middleware and Routes
- **Middleware:** Authentication middleware is used to protect routes.
- **Routes:** All routes are defined in `web.php`, using route groups with a prefix of `/dashboard` and naming them with the `admin` prefix. Match routes are used for handling GET and POST requests for login and registration.

### Error Handling
Custom 404 and 403 error pages are implemented. If a user tries to access a forbidden resource, a 403 error is triggered. If a user navigates to a non-existing page, they will be redirected to a 404 error page.

### Resources and Views
The application is structured as follows:
- **Views:** Located in the `resources/views/admin` directory, including layout files in `admin/layouts/app.blade.php` and partials in `admin/partials` for headers, footers, and sidebars.
- **Controllers:** 
  - `AuthController` handles user authentication.
  - `TaskController` is a resource controller for managing tasks.
  - `AdminController` is for managing Dasbboard.

### Database Migrations and Seeders
Database tables are created using Laravel migrations. The `UserSeeder`, `RoleSeeder`, `RolePermissionSeeder` and `TaskSeeder` classes are used to populate the database with initial data, including an admin user and sample tasks.

### Assets
All assets (CSS, JS, images) are stored in the `public/backend/assets` folder.

## Conclusion
This Task Management System provides a comprehensive solution for managing tasks effectively, with robust user authentication, role-based access, and a user-friendly interface. The project is designed for ease of use and scalability, making it suitable for various task management needs. 

Feel free to modify or extend this documentation as needed!