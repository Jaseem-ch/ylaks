# ApexProcure - Laravel E-Commerce & Item Request System (v1)

A structured, full-featured Laravel (PHP) application built for B2B item requests, bulk quote inquiries, catalog management, and admin fulfillment operations.

---

## 🌟 Key Features

1. **Storefront & Product Catalog**:
   - High-impact home landing page with featured domain categories and top hardware/machinery.
   - Searchable, filterable product catalog (Keyword search, Category filter, Availability status, Sorting).
   - Product detail page with technical specifications breakdown and instant "Add to Request Basket".

2. **Item Request Basket & Company Email Submission**:
   - Interactive item list manager with quantity adjustments.
   - **Submit Request Form**: Collects customer name, email, phone, company/org, delivery address, and project notes.
   - **Automatic Email Dispatch**: Formats itemized request into clean HTML email and sends it directly to company email (`sales@apexprocure.com`) and customer confirmation copy.
   - Generates unique reference code (`REQ-YYYYMMDD-XXXX`).

3. **Admin Dashboard & Inquiry Management**:
   - KPI metric cards (Total Requests, Pending Review, Active Products, Pipeline Value).
   - **Item Request Directory**: Search, filter by workflow status (`New`, `Under Review`, `Quoted`, `Approved`, `Completed`, `Cancelled`).
   - Detailed request inspector with line item breakdown, customer details, and internal sales notes updater.
   - Product CRUD (Create, Edit, Delete, Stock update, Image assignment).
   - Category CRUD manager.

---

## 🚀 How to Run Locally

### Prerequisites
- **PHP** >= 8.2 with `pdo_sqlite` enabled
- **Composer** (PHP Package Manager)

### Step-by-Step Setup

1. **Install Dependencies**:
   ```bash
   composer install
   ```

2. **Environment Configuration**:
   - Copy `env.example` to `.env` if not already present:
     ```bash
     cp env.example .env
     ```
   - Make sure `DB_CONNECTION=sqlite` is configured.

3. **Database Setup & Seeders**:
   - Run migrations and seed sample categories, products, admin and customer demo accounts:
     ```bash
     php artisan migrate:fresh --seed
     ```

4. **Launch Local Server**:
   ```bash
   php artisan serve
   ```
   Open your browser at `http://127.0.0.1:8000`.

---

## 🔑 Demo Account Credentials

| Role | Email | Password | Access |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@company.com` | `password` | Full Admin Dashboard, Item Request Inspector, Product/Category CRUD |
| **Customer** | `customer@company.com` | `password` | Storefront & Item Request Submission |

---

## 📦 Pushing to GitHub

To upload this repository to GitHub:

```bash
git init
git add .
git commit -m "Initial commit: ApexProcure Laravel Item Request Application"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPOSITORY.NET
git push -u origin main
```
