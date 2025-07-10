📱 Refurbmate – Premium Refurbished Smartphone Store

Refurbmate is a PHP-based e-commerce web application designed to display and sell premium refurbished smartphones. Customers can browse phones, add to cart, checkout, and track their orders. The admin panel allows order management and updates.

---

🚀 Features

 👥 Customer Side
- Browse refurbished smartphones with individual pages (mobile1.php to mobile12.php)
- Add to cart, update quantity, and remove items
- Place orders and view confirmation
- Track order status using Order ID

🔐 Admin Side
- Admin login and logout
- View and update order statuses (`Pending → Shipped → Delivered`)
- Update product info (via `update_product.php`)

---

🛠️ Tech Stack

| Layer      | Technology         |
|------------|--------------------|
| Frontend   | HTML, CSS, JavaScript |
| Backend    | PHP                |
| Database   | MySQL (via XAMPP)  |
| Server     | Apache (XAMPP)     |

---

📂 Key Files

| File / Folder        | Purpose                              |
|----------------------|--------------------------------------|
| `db.php`             | Database connection setup            |
| `phone.php`          | Main phone listing page              |
| `add_cart.php`       | Add items to cart                    |
| `view_cart.php`      | View cart and update/remove items    |
| `checkout.php`       | Order confirmation process           |
| `track_order.php`    | Order tracking for users             |
| `admin_index.php`    | Admin dashboard                      |
| `update_order_status.php` | Update order status            |
| `login_admin.php`    | Admin login                          |

---

🧪 How to Run Locally (XAMPP)

1. Download and install [XAMPP](https://www.apachefriends.org/index.html)
2. Move the project folder into your XAMPP `htdocs` directory  
   e.g. `C:\xampp\htdocs\project`
3. Start Apache and MySQL from the XAMPP Control Panel
4. Open browser:  
   `http://localhost/project/phone.php`
5. Import your database via `http://localhost/phpmyadmin`  
   *(Make sure to create a DB and import tables manually)*

---

