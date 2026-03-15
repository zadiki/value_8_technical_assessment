# 🚛 KK Wholesalers: Enterprise Inventory & POS

[![Laravel 12](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)](https://mysql.com)
[![CI/CD Status](https://github.com/kk-wholesalers/app/actions/workflows/deploy.yml/badge.svg)](https://github.com/kk-wholesalers/app/actions)

**KK Wholesalers** is a robust, multi-tenant inventory management solution designed to synchronize central hub operations with distributed branch networks. It manages the full lifecycle of goods from central procurement to localized store sales.

## 🏛 System Hierarchy

Our architecture follows a strictly hierarchical model to ensure data integrity across the supply chain:

* **Central Warehouse:** The primary entry point for all bulk procurement.
* **Branches:** Regional headquarters (e.g., Nairobi, Mombasa, Kisumu).
* **Stores:** Each Branch contains **multiple sub-stores** (e.g., Front-end Store, Bulk Store, Cold Storage).
* **Users:** Linked directly to a specific Store via a Many-to-One relationship.

---

## 🚀 Key Modules

### 📦 Central Dispatch & Ordering
* **LPO Management:** Integrated Local Purchase Orders for external suppliers.
* **Push Distribution:** Bulk dispatch from Central Warehouse to Branch Stores based on demand forecasting.
* **Stock Tracking:** Real-time visibility of total company assets vs. branch-specific holdings.

### 🔄 Inter-Store Transfers
* **Branch-to-Branch:** Formalized stock movement between regional hubs.
* **Intra-Branch:** Moving stock between a branch’s "Bulk Store" and its "POS Store."
* **Digital Waybills:** Automated generation of transfer documents and delivery notes.

### 💳 Point of Sale (POS)
* **Multi-Store Inventory:** Cashiers pull stock only from their assigned store in real-time.
* **Session Security:** End-of-day reconciliation reports for every cashier and store manager.
* **Mixed Payments:** Seamless handling of Cash, Mobile Money (M-Pesa), and Credit.

---

## 🛠 Tech Stack

* **Framework:** Laravel 12.x
* **Language:** PHP 8.4+
* **Database:** MySQL 8.0 (Production) / SQLite (Testing)
* **DevOps:** GitHub Actions (Pint, PHPUnit, SSH Deploy)
* **Styling:** Tailwind CSS & Livewire

---

## ⚙️ Setup & Installation

1.  **Clone & Install:**
    ```bash
    git clone [https://github.com/kk-wholesalers/inventory.git](https://github.com/kk-wholesalers/inventory.git)
    composer install
    npm install && npm run build
    ```

2.  **Environment Configuration:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3.  **Database Sync:**
    ```bash
    # Ensure MySQL is running
    php artisan migrate --seed
    ```

4.  **Local Testing (SQLite):**
    ```bash
    php artisan test
    ```

---

## 📊 Database Relationship Summary

| Table | Relationship | Purpose |
| :--- | :--- | :--- |
| **Branches** | `hasMany(Store)` | Defines regional headquarters. |
| **Stores** | `belongsTo(Branch)` | Physical locations holding stock. |
| **Users** | `belongsTo(Store)` | Restricts access to specific inventory. |
| **Products** | `belongsToMany(Store)` | Tracks quantity via `store_product` pivot. |

---

## 🛡 Security & Compliance

* **Role-Based Access (RBAC):** Users are strictly scoped to their assigned Store.
* **Audit Logs:** Every stock movement is tracked with User ID and Timestamp.
* **Automated CI:** Deployments only trigger if all **Unit and Feature tests** pass.

---

© 2026 KK Wholesalers Ltd. Internal System.
