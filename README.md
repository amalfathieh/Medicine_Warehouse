
## **Medicine_Warehouse**

The project allows the pharmacist to communicate with warehouse and order medicines from it, in addition to 
browsing the medicines in the warehouse through several methods, I used sanctum auth.
<small>
- Register, Login, logout.
- Warehouse owner can add medicines with details.
- Users can search for specific categories or medicines by name or category.
- Pharmacists can place orders from the warehouse and review their orders and track their status.
- Warehouse owners can review orders, change their status.
- Users can add medicines to their favorites list.
</small>

## **Prerequisites**
You should have **`composer`** installed. If you don't install composer from here.

## **Installation**

To install Medicine_Warehouse, follow these steps:

1. Clone the repository: **`git clone https://github.com/amalfathieh/Medicine_Warehouse.git`**
2. Navigate to the project directory: **`cd Medicine_Warehouse`**
3. Run this command to download composer packages:
    **composer install`**
4. Run this command to update composer packages:
    **`composer update`**
5. Create a copy of your .env file: **`cp .env.example .env`**
6. Generate an app encryption key: **`php artisan key:generate`**

7. Create an empty database for our application in your DBMS
8. In the .env file, add database information to allow Laravel to connect to the database
9. Migrate the database: **`php artisan migrate`**

10. Seed the database : **`php artisan db:seed`**
11. Open up the server: **`php artisan serve`**
    
   
