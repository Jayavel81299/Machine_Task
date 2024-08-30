## Setup Instructions

To get your Laravel application up and running, follow these steps:

### **Step 1: Update Composer Dependencies**

Run the following command to update your project's dependencies to the latest versions specified in your composer.json file:

```bash
composer update

### **Step 2: Run Migrations**

Apply any pending migrations to your database by executing:

```bash
php artisan migrate

This will create or modify the database tables as defined in your migration files.

### **Step 3: Seed the Database**

Populate your database with sample or initial data using the seeder classes:

php artisan db:seed

This command runs all the seeders listed in DatabaseSeeder.php, allowing you to pre-fill your database with necessary data.




