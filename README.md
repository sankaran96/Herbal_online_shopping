# HerbNest – Online Herb Shopping System

A PHP + MySQL reconstruction inspired by the uploaded college project report, **“Neural Network Based Approach on Segmental Analysis for Purchasing Herbs Online.”** This version focuses on the report's two portals (customer and admin), herb catalogue, product details, and online order workflow.

## Requirements
- Windows 10/11
- XAMPP (Apache, PHP 8+, MySQL)
- Browser with internet access for the externally hosted real product photographs and Google Fonts

## Installation
1. Extract the ZIP.
2. Copy the `Herbal_Online_Shopping_Project` folder to `C:\xampp\htdocs\`.
3. Open XAMPP Control Panel and start **Apache** and **MySQL**.
4. Visit `http://localhost/phpmyadmin`.
5. Import `database/herbal_shopping.sql`.
6. If your MySQL root password is not blank, update `config/database.php`.
7. Open `http://localhost/Herbal_Online_Shopping_Project/`.
8. Create a customer account using **Create an account**.
9. Create your admin account at `http://localhost/Herbal_Online_Shopping_Project/setup_admin.php`. Choose your own admin username and a strong password of at least 10 characters.
10. After creating the admin, delete `setup_admin.php` from the project folder.
11. Admin login: `http://localhost/Herbal_Online_Shopping_Project/admin.php`.

## Separate pages
- `index.php` – home page
- `products.php` – product listing and search
- `product-details.php` – product details and add to basket
- `cart.php` – quantities and basket total
- `checkout.php` – customer checkout
- `orders.php` – order history
- `usage.php` – herb guide
- `login.php`, `register.php`, `logout.php` – customer account
- `admin.php` – administrator login
- `admin/dashboard.php` – admin dashboard
- `admin/add-herb.php`, `admin/manage-herbs.php` – product management
- `admin/manage-orders.php` – order status management
- `admin/users.php` – customer list

## Database
The SQL creates `customers`, `admins`, `herbs`, `orders`, and `order_items`. Customer and admin passwords are stored using PHP `password_hash()`; login uses `password_verify()`. Forms use session-based CSRF tokens. Queries use PDO prepared statements.

## About the segmentation title
The uploaded report discusses neural-network customer-behaviour analysis and clustering/segmental analysis. This reconstructed web application includes the e-commerce data foundation (customer registrations, order history, product categories and quantities). It does **not** claim that a trained neural network is already integrated into the live shopping portal. A separate, documented training module can be added when you provide the exact dataset/features or want a reproducible segmentation experiment.

## Images
The catalogue uses direct image URLs to real photographic images hosted by Unsplash. Internet access is required to display them. For a fully offline deployment, download licensed image files and replace the `image_url` values in the SQL/admin product records.

## Notes
- This is an academic demonstration, not a production-ready payment system.
- Checkout records orders; no real payment gateway is connected.
- Stock is displayed but not yet decremented on order placement.
- Do not use real customer passwords or personal data in a public demo.
