# SIMPosyandu - Sistem Informasi Manajemen Posyandu


SIMPosyandu is a web-based application built with the Laravel framework to manage and monitor child health data at a Posyandu (Integrated Health Post). This system is designed to streamline data management for administrators, health cadres (kader), and parents (orang tua).

## Key Features

The application provides functionalities tailored to three distinct user roles: Admin, Kader (Health Cadre), and Orang Tua (Parent).

### 1. Admin Portal (`/admin`)
The admin has full control over the system's data and users.
- **Dashboard:** An overview of the management modules.
- **User Management:** Create, read, update, and delete Kader and Orang Tua user accounts.
- **Balita (Toddler) Data:** Full CRUD operations for toddler profiles.
- **Jadwal Posyandu:** Manage schedules for Posyandu activities.
- **Vendor Management:** Manage data for vendors supplying vitamins and vaccines.
- **Vitamin & Imunisasi Data:** Manage the list of available vitamins and immunizations.
- **KMS (Child Growth Chart) Records:** Full access to view, add, edit, and delete KMS records for all toddlers.

### 2. Kader (Health Cadre) Portal (`/kader`)
Kaders are responsible for on-the-ground data entry and management.
- **Dashboard:** A simplified dashboard with quick access to essential features.
- **Balita (Toddler) Data:** Add, view, update, and delete toddler profiles.
- **KMS (Child Growth Chart) Records:** Input and manage health check-up data for toddlers, including weight, height, and immunizations administered.

### 3. Orang Tua (Parent) Portal (`/orangtua`)
Parents can monitor their children's health and stay informed.
- **Dashboard:** A personalized view for parents.
- **Data Balita Saya:** View detailed profiles and health records (KMS) for their own children.
- **Jadwal Posyandu:** View upcoming Posyandu schedules and activities.

## Technology Stack

- **Backend:** PHP 8.1+, Laravel 10
- **Frontend:** Bootstrap 5, Sass, Vite
- **Database:** MySQL

## Getting Started

Follow these steps to set up and run the project on your local machine.

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- A database server (e.g., MySQL)

### Installation

1.  **Clone the repository:**
    ```sh
    git clone https://github.com/evankepin/SIMposyandu.git
    cd simposyandu
    ```

2.  **Install PHP dependencies:**
    ```sh
    composer install
    ```

3.  **Install JavaScript dependencies:**
    ```sh
    npm install
    ```

4.  **Set up the environment file:**
    ```sh
    cp .env.example .env
    ```

5.  **Generate an application key:**
    ```sh
    php artisan key:generate
    ```

6.  **Configure your database:**
    Open the `.env` file and set your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=simposyandu
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7.  **Run database migrations:**
    This will create all the necessary tables in your database.
    ```sh
    php artisan migrate
    ```

8.  **Compile frontend assets:**
    ```sh
    npm run build
    ```
    For development, you can use:
    ```sh
    npm run dev
    ```

9.  **Start the development server:**
    ```sh
    php artisan serve
    ```
    The application will be available at `http://127.0.0.1:8000`.

## Usage

After installation, you can access the application. Since there are no default seeders, you will need to create user accounts.

1.  **Register a User:** The public registration form at `/register` creates a user with the default `orangtua` (parent) role.
2.  **Create Admin/Kader:** To create an `admin` or `kader`, you can manually change a user's role in the `users` table in your database or create a custom seeder.
3.  **Access Portals:**
    - **Admin:** Log in with an admin account and navigate to `/admin/dashboard`.
    - **Kader:** Log in with a kader account and navigate to `/kader/dashboard`.
    - **Orang Tua:** Log in with an orang tua account and navigate to `/orangtua/dashboard`.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
