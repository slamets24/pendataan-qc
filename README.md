# Pendataan-QC: Quality Control Management System 📊

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Primary Language: Blade](https://img.shields.io/badge/Language-Blade-blue.svg)]()
[![Stars](https://img.shields.io/github/stars/slamets24/pendataan-qc?style=social)]()
[![Forks](https://img.shields.io/github/forks/slamets24/pendataan-qc?style=social)]()

A comprehensive web application for managing quality control processes, inventory tracking, and purchase order management. Built with Laravel, this system provides a user-friendly interface to streamline QC operations and improve overall efficiency.

## 📑 Table of Contents
- [About](#about)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)
- [Important Links](#important-links)
- [Footer](#footer)

## 💡 About
This application is designed to streamline quality control (QC) processes, manage inventory, and handle purchase orders. Key features include tracking incoming and outgoing goods, managing revisions, and providing insights through comprehensive data visualization. It's built using Laravel and leverages technologies like Alpine.js and Tailwind CSS for a modern and responsive user interface.

## ✨ Features
- **Dashboard Overview:** Get a quick snapshot of key metrics including total brands, articles, incoming goods, outgoing goods, revisions, and QC processed items. 📈
- **Brand Management:** Add, edit, and manage different brands with types (PO, Reseller, Store Stock, Makloon). 🏢
- **Article Management:** Categorize and track articles associated with specific brands. 🏷️
- **Color and Size Management:** Define available colors and sizes for products. 🎨📏
- **Sales Channel Management:** Manage different sales channels associated with brands. 📢
- **Purchase Order (PO) Management:** Create, track, and manage purchase orders with automated PO number generation. 📝
- **Incoming Goods Tracking:** Track incoming stock, their QC status, and link them to POs. 📦
- **QC Summary:** Summarize quality control processes like hanging, buttoning, plating, steaming, and thread trimming. ✅
- **Revision Tracking:** Track revisions with tailor and QC codes for detailed analysis. 🔄
- **Outgoing Goods Management:** Manage goods sent for packing and track their status. 🚚
- **Reporting:** Data visualization with charts for QC processes, stock status, and monthly trends. 📊
- **User Authentication:** Secure login and registration with role-based access control (Admin, Staff). 🔒

## 🛠️ Tech Stack
- **Backend Framework:** Laravel (PHP) 💻
- **Frontend Framework:** Blade (Templating Engine), Alpine.js, JavaScript 🎨
- **Styling:** Tailwind CSS, Bootstrap 🖌️
- **Charts:** Chart.js 📊
- **Package Management:** npm, Composer 📦
- **Other:** Axios, Vite

## ⚙️ Installation
1.  **Clone the repository:**
   ```bash
   git clone https://github.com/slamets24/pendataan-qc.git
   cd pendataan-qc
   ```
2.  **Install Composer dependencies:**
   ```bash
   composer install
   ```
3.  **Copy the environment file:**
   ```bash
   cp .env.example .env
   ```
4.  **Generate application key:**
   ```bash
   php artisan key:generate
   ```
5.  **Configure your database:**
    -   Edit the `.env` file with your database credentials. The default connection is SQLite, but you can configure MySQL or other database connections.
    -   For SQLite, ensure the database file exists:
       ```bash
       touch database/database.sqlite
       ```
6.  **Run database migrations:**
   ```bash
   php artisan migrate
   ```
7.  **Install npm dependencies:**
   ```bash
   npm install
   ```
8.  **Build the assets using Vite:**
   ```bash
   npm run build
   ```

## 🚀 Usage
1.  **Serve the application:**
   ```bash
   php artisan serve
   ```
2.  **Access the application** in your web browser at `http://localhost` or the specified address.
3.  **Initial Setup:** Seed the database with initial data:
 ```bash
 php artisan db:seed
 ```
4.  **Access the application**Login with credentials from database seed.


### Real World Use Cases

Imagine a garment manufacturing company aiming to optimize its quality control and production processes. This system can be used to:

*   **Track incoming fabrics and accessories** when they arrive at the warehouse.
*   **Manage QC checkpoints** for each stage of production such as hanging, buttoning, plating, and steaming.
*   **Record revisions** and assign them to specific tailors, ensuring accountability.
*   **Monitor outgoing goods** sent to packing and dispatch.
*   **Generate reports** on common defects, tailor performance, and overall production efficiency.

### How to Use

1.  **Brands**: Start by defining different brands your company handles (e.g., Azzahra, Makloon).
2.  **Articles**: Categorize each type of product, such as dresses, scarves, or bergos.
3.  **Colors and Sizes**: Define available variations for each product.
4.  **Purchase Orders**: Create POs to track orders from different brands.
5.  **Incoming Goods**: Register incoming stock by linking them to brands, articles, and POs.
6.  **QC Summaries**: Record QC processes performed on the incoming goods.
7.  **Revisions**: Track any revisions needed and assign them to tailors.
8.  **Outgoing Goods**: Manage the transfer of goods to the packing department.

## 📂 Project Structure
```
├── app/
│   ├── Http/
│   │   ├── Controllers/ - Controllers for handling HTTP requests.
│   │   ├── Requests/ - Form request classes for validation.
│   ├── Models/ - Eloquent models representing database tables.
│   ├── Providers/ - Service providers for application bootstrapping.
│   └── View/ 
│       └── Components/ - Blade components for reusable UI elements
├── bootstrap/ - Bootstrapping code.
├── config/ - Application configuration files.
├── database/
│   ├── factories/ - Factories for generating model instances.
│   ├── migrations/ - Database migration files.
│   └── seeders/ - Database seeders to populate initial data.
├── public/ - Publicly accessible files.
├── resources/
│   ├── css/ - CSS stylesheets (Tailwind CSS).
│   ├── js/ - JavaScript files (Alpine.js).
│   └── views/ - Blade templates for the application's UI.
├── routes/ - Route definitions for web, API, and console.
├── storage/ - Storage directory for logs, cache, and sessions.
└── tests/ - PHPUnit tests for the application.
```

## ✍️ Contributing
Contributions are welcome! Please follow these steps:

1.  Fork the repository. 🍴
2.  Create a new branch. 🌿
3.  Make your changes.
4.  Submit a pull request. 🚀

## 📜 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🔗 Important Links
- [slamets24's Github Profile](https://github.com/slamets24)
- [Pendataan-qc Repository](https://github.com/slamets24/pendataan-qc)

## <footer>

							Made with ❤️ by [slamets24](https://github.com/slamets24) - Fork it on [GitHub](https://github.com/slamets24/pendataan-qc)! Give it a ⭐, raise an 🐞 if found.
							Contact: slamets.tn@gmail.com
							 
							© 2024 Quality Control System. All rights reserved.
</footer>


---
**<p align="center">Generated by [ReadmeCodeGen](https://www.readmecodegen.com/)</p>**
