# 🚀 LaraLearn - "Let's Learn Laravel & Livewire" Course Project

This repository contains the source code for the `LaraLearn` project, developed as part of the Udemy course **["Let's Learn Laravel & Livewire: A Guided Path For Beginners"](https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/)**, taught by instructor **[Brad Schiff](https://www.udemy.com/user/bradschiff/)**.

The project's goal is to build a simple social application, similar to a blog or Twitter, to practice the fundamental concepts and best practices of the Laravel and Livewire ecosystem.

---

## ⚙️ Prerequisites

Before you begin, ensure you have the following development environment set up:

* A local server environment (e.g., Laragon, XAMPP, WAMP, Herd)
* PHP 8.2 or higher
* Composer
* A database (MySQL, MariaDB, etc.)

---

## 📝 Installation and Setup Guide

Follow these steps to set up the project in a new environment.

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/Robson16/laralearn.git
    cd laralearn
    ```

2.  **Install PHP Dependencies**
    Run Composer to download all the required packages.
    ```bash
    composer install
    ```

3.  **Set Up the Environment**
    Copy the example environment file and generate the application key.
    ```bash
    # For Windows
    copy .env.example .env

    # For MacOS/Linux
    cp .env.example .env
    ```
    Then, generate the key:
    ```bash
    php artisan key:generate
    ```

4.  **Configure the Database**
    Open the `.env` file and configure your database variables (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5.  **Configure Pusher for Real-Time Chat (📡 Important)**
    This project uses Pusher Channels for its real-time chat functionality.
    
    1.  Create a free account at [pusher.com](https://pusher.com/).
    2.  Create a new **Channels** application.
    3.  Go to the "App Keys" section of your new Pusher app and copy the credentials.
    4.  Open your `.env` file and fill in the following variables:

    ```env
    BROADCAST_CONNECTION=pusher

    PUSHER_APP_ID=your_app_id
    PUSHER_APP_KEY=your_app_key
    PUSHER_APP_SECRET=your_app_secret
    PUSHER_APP_CLUSTER=your_app_cluster
    ```
    *The `VITE_PUSHER_...` variables will be populated automatically.*

6.  **Run the Migrations (❗️ Important)**
    This command will create all the necessary tables in the database you configured.
    ```bash
    php artisan migrate
    ```

7.  **Create the Storage Link (❗️ Important)**
    To make file uploads (like avatars) publicly accessible, run this command. It creates a shortcut from `public/storage` to `storage/app/public`.
    ```bash
    php artisan storage:link
    ```

8.  **Access the Application**
    Done! You can now access the project through your local server (e.g., `http://laralearn.test`).

---

## 🔧 Recommended `php.ini` Configuration (Critical!)

To avoid common issues with file uploads and image processing, it is **highly recommended** that your `php.ini` file includes the following settings. In an environment like Laragon, you can easily access this file through the menu.

```ini
; Ensures that PHP has permission to write to a temporary folder.
; Point this to the 'tmp' folder of your Laragon installation or similar.
upload_tmp_dir = "C:/laragon/tmp"

; Enables the GD library, which is required for image manipulation (e.g., with the Intervention/Image library).
extension=gd

; Allows for larger file uploads (adjust as needed).
upload_max_filesize = 50M
post_max_size = 50M
```

**Remember to restart your server (Apache/Nginx) after any changes to `php.ini`!**
