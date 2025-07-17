

# My Laravel Form Builder

This project is a web application built with Laravel, allowing users to create and manage custom forms with various field types and validation rules. It leverages Laravel Breeze for authentication and a robust backend for form data management.

## Technologies Used

  * **Laravel Framework:** The robust PHP framework for web artisans.
  * **Laravel Breeze:** A simple, minimal starting point for building Laravel applications with authentication scaffolding.
  * **Tailwind CSS:** A utility-first CSS framework for rapid UI development.
  * **MySQL (or your preferred database):** Relational database for storing form data and configurations.

## Getting Started

Follow these steps to get your project up and running locally.

### Prerequisites

Before you begin, ensure you have the following installed:

  * **PHP:** Version 8.1 or higher.
  * **Composer:** PHP dependency manager.
  * **Node.js & npm (or Yarn):** For compiling frontend assets.
  * **A Database:** MySQL, PostgreSQL, SQLite, etc. (MySQL is commonly used with Laravel).

### Installation

1.  **Clone the repository:**

    ```bash
    git clone <your-repository-url>
    cd my-laravel-form-builder
    ```

2.  **Install Composer dependencies:**

    ```bash
    composer install
    ```

3.  **Install Node dependencies:**

    ```bash
    npm install
    # OR
    yarn install
    ```

4.  **Create a copy of your environment file:**

    ```bash
    cp .env.example .env
    ```

5.  **Generate an application key:**

    ```bash
    php artisan key:generate
    ```

6.  **Configure your `.env` file:**

    Open the `.env` file and update the following sections:

      * **Database Configuration:**

        ```env
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=your_database_name
        DB_USERNAME=your_database_user
        DB_PASSWORD=your_database_password
        ```

        Replace `your_database_name`, `your_database_user`, and `your_database_password` with your actual database credentials.

      * **Mail Configuration (for `Notification_email` and other mail features):**

        ```env
        MAIL_MAILER=smtp
        MAIL_HOST=mailpit # or smtp.mailtrap.io, smtp.sendgrid.net, etc.
        MAIL_PORT=1025 # or 587, 2525, etc.
        MAIL_USERNAME=null # Your mail username (e.g., Mailtrap username, SendGrid API Key ID)
        MAIL_PASSWORD=null # Your mail password (e.g., Mailtrap password, SendGrid API Key)
        MAIL_ENCRYPTION=null # or tls, ssl
        MAIL_FROM_ADDRESS="hello@example.com" # Your sender email address
        MAIL_FROM_NAME="${APP_NAME}" # Your sender name
        ```

        **Important:** Configure these settings with your actual mail service provider credentials (e.g., Mailtrap for development, SendGrid, Mailgun, AWS SES for production).

7.  **Run database migrations:**

    This will create the necessary tables in your database, including those for forms, fields, and Laravel Breeze's authentication.

    ```bash
    php artisan migrate
    ```

8.  **Link the storage directory:**

    This command creates a symbolic link from `public/storage` to `storage/app/public`, allowing your application to serve user-uploaded files.

    ```bash
    php artisan storage:link
    ```

9.  **Compile frontend assets:**

    ```bash
    npm run dev
    # OR
    yarn dev
    ```

    For production, use `npm run build` or `yarn build`.

10. **Start the local development server:**

    ```bash
    php artisan serve
    ```

11. **Start the queue worker:**

    To process background tasks like email notifications, you need to run a queue worker. Open a **separate terminal** and run:

    ```bash
    php artisan queue:work
    ```

    You might want to configure a more robust queue system for production (e.g., Redis, database queue).

12. **Access the application:**

    Open your web browser and navigate to `http://127.0.0.1:8000` (or the address shown in your `php artisan serve` output).

## Usage

1.  **Register/Login:** Upon first visit, register a new user or log in if you already have an account.
2.  **Navigate to Forms:** After logging in, you should be able to navigate to the form management section (e.g., `/forms`).
3.  **Create/Edit Forms:** Use the interface to define your forms, add fields, set their types, and apply validation rules.
4.  **View Submissions:** (Assuming you have a mechanism for this) Form submissions will likely be stored in the database, and you might have a dedicated section to view them.
5.  **Email Notifications:** When forms are submitted, email notifications will be queued and sent to the configured recipients, provided your mail settings and queue worker are running.

