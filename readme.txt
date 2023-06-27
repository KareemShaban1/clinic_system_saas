# Clinic Management System Laravel Project

This repository contains a clinic management system project built using the Laravel framework. The project aims to provide an efficient and user-friendly solution for managing appointments, patient records, and clinic operations.

![Project Screenshot](/screenshots/homepage.png)

## Features

The clinic management system Laravel project includes the following features:

1. User Authentication: Users can register, log in, and manage their accounts.
2. Appointment Scheduling: Patients can request appointments, and staff can manage and schedule appointments.
3. Patient Management: Staff can manage patient records, including personal information, medical history, and appointments.
4. Doctor Management: Admins can manage doctors, including their specialties and availability.
5. Billing and Invoicing: Staff can generate bills and invoices for patients and track payment status.
6. Prescription Management: Doctors can create and manage prescriptions for patients.
7. Medical Reports: Doctors can generate medical reports for patients and attach them to their records.
8. Search Functionality: Users can search for patients, doctors, appointments, and medical records.
9. Dashboard and Analytics: Staff and admins have access to a dashboard with analytics and key performance indicators.
10. Email Notifications: Users receive email notifications for appointment reminders and updates.

## Prerequisites

Before running the clinic management system Laravel project, ensure you have the following dependencies installed:

- PHP (>= 7.4)
- Composer
- MySQL
- Node.js (for compiling assets)

## Installation

1. Clone the repository:

   ```shell
   git clone https://github.com/your-username/clinic-management-system-laravel.git
   ```

2. Navigate to the project directory:

   ```shell
   cd clinic-management-system-laravel
   ```

3. Install PHP dependencies:

   ```shell
   composer install
   ```

4. Copy the `.env.example` file and rename it to `.env`. Update the necessary database and mail configurations in the `.env` file.

5. Generate a new application key:

   ```shell
   php artisan key:generate
   ```

6. Run database migrations and seeders:

   ```shell
   php artisan migrate --seed
   ```

7. Install JavaScript dependencies:

   ```shell
   npm install
   ```

8. Compile assets:

   ```shell
   npm run dev
   ```

9. Start the development server:

   ```shell
   php artisan serve
   ```

10. Access the application by visiting `http://localhost:8000` in your web browser.

## Usage

- Visit the homepage and create an account or log in if you already have one.

  ![Homepage](/screenshots/homepage.png)

- As a patient, you can request appointments, view your medical records, and manage your profile.

  ![Patient Dashboard](/screenshots/patient-dashboard.png)

- As staff or admin, you can manage appointments, patient records, doctors, and generate reports.

  ![Admin Dashboard](/screenshots/admin-dashboard.png)

- Explore the various features and functionalities of the clinic management system Laravel project.

## Contributing

Contributions are welcome! If you find any bugs or want to add new features, please open an issue or submit a pull request to the repository