<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="phone.css">
    <style>
       * {
    margin: 0;
    padding: 0;
    font-family: sans-serif;
}
h1 {
    color: Grey;
    font-size: 2em;
    margin-block-start: 0.67em;
    margin-block-end: 0.67em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    unicode-bidi: isolate;
}
.banner {
    width: 100%;
    background-image: linear-gradient(rgba(255, 255, 255, 0.75), #35c1bebf);
    background-size: cover;
    background-position: center;
}
.navbar {
    margin: auto;
    padding: 15px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.logo {
    width: 120px;
    cursor: pointer;
}
.navbar ul li {
    list-style: none;
    display: inline-block;
    margin: 0 20px;
    position: relative;
}
.navbar ul li a {
    text-decoration: none;
    color: #080808;
    text-transform: uppercase;
}
.navbar ul li::after {
    content: '';
    height: 3px;
    width: 0%;
    background: #009688;
    position: absolute;
    left: 0;
    bottom: -10px;
    transition: 0.5s;
}
.navbar ul li:hover::after {
    width: 100%;
}
.dropdown:hover .dropdown-content {
    display: block;
    height: max-content;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #333;
    min-width: 160px;
    z-index: 1;
    padding: 10px; /* Add padding inside the dropdown */
}
.dropdown-content li {
    padding: 5px 10px; /* Add padding around each list item */
}
.dropdown-content li a {
    display: block; /* Ensure the padding is applied properly */
    padding: 8px 12px; /* Add padding inside each link */
    text-decoration: none;
    color: white;
}
.dropdown-content li a:hover {
    background-color: #575757;
}
.logout-link {
    color: white;
}
.content {
    text-align: center;
    color: #fff;
    padding: 0px 100px;
    flex: 1;
}
.content h1 {
    font-size: 70px;
    margin-top: 80px;
}
button {
    width: 200px;
    padding: 15px 0;
    text-align: center;
    margin: 20px 10px;
    border-radius: 25px;
    font-weight: bold;
    border: 2px solid #009688;
    background: transparent;
    color: #7b7979;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
span {
    background: #009688;
    height: 100%;
    width: 0%;
    border-radius: 25px;
    position: absolute;
    left: 0;
    bottom: 0;
    z-index: -1;
    transition: 0.5s;
}
button:hover span {
    width: 100%;
}
button:hover {
    border: none;
}
.cor {
    background-color: #8080800a;
}
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    overflow: hidden; /* Remove default scrollbars */
}
.news-container {
    width: 100%;
    height: 100px;
    overflow: hidden;
    background-color: #333;
    color: white;
}
.news-content {
    display: flex;
    flex-direction: column;
    animation: slideUp 10s linear infinite;
}
.news-item {
    padding: 20px;
    border-bottom: 1px solid #444; /* Adds separation between news items */
}
@keyframes slideUp {
    0% {
        transform: translateY(100%);
    }
    100% {
        transform: translateY(-100%);
    }
}
.gallery-container {
    text-align: center;
    background: #fff;
    padding: 20px 30px 25px 300px;
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: max-content;
    max-width: 900px;
    overflow: hidden;
}
.gallery-container h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
    border-bottom: 2px solid #333;
    display: inline-block;
    padding-bottom: 5px;
}
.gallery {
    display: flex;
    align-items: center;
    position: relative;
    justify-content: center;
    width: fit-content;
}
.gallery-images {
    display: flex;
    transition: transform 0.3s ease-in-out;
    width: calc(100% * 4); /* Adjust for the number of images */
}
.gallery-images img {
    width: 277px;
    max-width: 100%;
    height: auto;
    flex-shrink: 0;
    border-radius: 5px;
    margin-right: 10px;
}
/* Footer Styling */
footer {
    background-color: #7e908f;
    color: white;
    padding: 25px 0;
    width: 100%;
}
.footer-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.footer-left, .footer-center, .footer-right {
    flex: 1;
    text-align: center;
}
.footer-center ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-center ul li {
    display: inline-block;
    margin: 0 10px;
}
.footer-center ul li a {
    color: white;
    text-decoration: none;
    font-size: 14px;
}
.footer-center ul li a:hover {
    text-decoration: underline;
}
.footer-right a {
    color: white;
    margin: 0 10px;
    text-decoration: none;
}
.footer-right a:hover {
    text-decoration: underline;
}
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
    }
    .footer-center ul li {
        display: block;
        margin: 5px 0;
    }
}
.col_sm1 {
    margin: 0 auto;
    width: 48%;
    padding: 0;
}
       .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 items per row */
            gap: 15px;
            background-color: #e0f7f9; /* light blue like your image */
            padding: 20px;
        }
        .product-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
            padding: 10px;
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            background-color: #f5f5f5; /* Optional background */
        }
        .product-info {
            margin-top: 10px;
        }
        .product-title {
            font-weight: bold;
            font-size: 16px;
            margin: 5px 0;
        }
        .product-price {
            font-size: 14px;
            color: #555;
        }
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }
        header, footer {
            flex-shrink: 0;
        }
        main {
            flex: 1;
            overflow-y: auto;
        }
        .cart-container {
            display: flex;
            align-items: center;
        }
        .cart-container img {
            width: 24px;
            height: 24px;
            margin-right: 5px;
        }
        .cart-container a {
            text-decoration: none;
            color: #080808;
            text-transform: uppercase;
        }
        .search-bar, .filter-bar {
            margin: 20px auto;
            text-align: center;
        }
        .search-bar input, .filter-bar select {
            padding: 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
    </style>
    <title>Refurbmate</title>
</head>
<body>
    <header class="banner">
        <div class="navbar cor">
            <h1>Refurbmate</h1>
            <ul>
                <li><a href="phone.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Log out</a></li>
                <?php else: ?>
                    <li><a href="login.php">Log in</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
                <li>
                    <a href="track_order.php">Orders</a>
                </li>
                <li class="cart-container">
                    <img src="cart3.png" alt="Cart Logo">
                    <a href="view_cart.php">Cart</a>
                </li>
            </ul>
        </div>
    </header>
    <main>
    <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Search for products..." onkeyup="filterProducts()">
        </div>
        <div class="filter-bar">
            <select id="priceFilter" onchange="filterProducts()">
                <option value="all">All Prices</option>
                <option value="0-50000">Under ₹50,000</option>
                <option value="50000-100000">₹50,000 - ₹1,00,000</option>
                <option value="100000-150000">₹1,00,000 - ₹1,50,000</option>
                <option value="150000">Above ₹1,50,000</option>
            </select>
            <select id="brandFilter" onchange="filterProducts()">
                <option value="all">All Brands</option>
                <option value="apple">Apple</option>
                <option value="samsung">Samsung</option>
                <option value="google">Google</option>
                <option value="oneplus">OnePlus</option>
                <option value="rog">ROG</option>
                <option value="vivo">Vivo</option>
                <option value="motorola">Motorola</option>
            </select>
        </div>
            <div class="product-grid"id="productGrid">
                <div class="product-card" data-price="155900" data-brand="apple">
                    <img src="i_phone16promax.jpg" alt="iPhone 16 pro max">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile1.php" target="_blank" style="text-decoration: none; color: black;"> iPhone 16 Pro Max 1 TB: 5G Mobile Phone (Desert Titanium)</a></div>
                        <div class="product-price">Starting from ₹6,495/m or ₹1,55,900</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="1"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="149999" data-brand="samsung">
                    <img src="Samsung-Galaxy-S25-Ultra.jpg" alt="Samsung Phone Samsung-Galaxy-S25-Ultra">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile2.php" target="_blank" style="text-decoration: none; color: black;">Samsung Galaxy S25 Ultra 5G AI Smartphone (Titanium Silverblue, 12GB RAM, 1TB Storage)</a></div>
                        <div class="product-price">Starting from ₹6,249/m or ₹1,49,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="2"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="95999" data-brand="google">
                    <img src="pixel-9-pro.webp" alt="pixel-9-pro">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile3.php" target="_blank" style="text-decoration: none; color: black;">Google Pixel 9 Pro (Hazel, 256 GB)  (16 GB RAM)</a></div>
                        <div class="product-price">Starting from ₹3,999/m or ₹95,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="3"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="59999" data-brand="oneplus">
                    <img src="OnePlus 13.jpg" alt="OnePlus 13">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile4.php" target="_blank" style="text-decoration: none; color: black;">OnePlus 13 | Smarter with OnePlus AI (12GB RAM, 256GB Storage Midnight Ocean)</a></div>
                        <div class="product-price">Starting from ₹2,499/m or ₹59,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="4"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="109999" data-brand="rog">
                    <img src="Rog phone 8.png" alt="Rog phone 8">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile5.php" target="_blank" style="text-decoration: none; color: black;">Rog Phone 8 Pro (24GB of RAM and 1TB of inbuilt storage)</a></div>
                        <div class="product-price">Starting from ₹4,583/m or ₹1,09,999 </div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="5"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="89999" data-brand="samsung">
                    <img src="Samsung Galaxy Z Fold5 5G.jpg" alt="Samsung Galaxy z fold">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile6.php" target="_blank" style="text-decoration: none; color: black;">SAMSUNG Galaxy Z Fold5 (Icy Blue, 512 GB)  (12 GB RAM)</a></div>
                        <div class="product-price">Starting from ₹3,749/m or ₹89,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="6"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="139999" data-brand="vivo">
                    <img src="vivo X Fold3 Pro 5G.jpg" alt="vivo X Fold3 Pro 5G">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile7.php" target="_blank" style="text-decoration: none; color: black;">vivo X Fold3 Pro (Celestial Black, 512 GB)  (16 GB RAM)</a></div>
                        <div class="product-price">Starting from ₹5,833/m or ₹₹1,39,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="7"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="39999" data-brand="motorola">
                    <img src="moto edge 50 ultra.webp" alt="moto edge 50 ultra">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile8.php" target="_blank" style="text-decoration: none; color: black;">Motorola Edge 50 Ultra 5G (Nordic Wood, 512 GB)  (12 GB RAM)</a></div>
                        <div class="product-price">Starting from ₹1,666/m or ₹39,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="8"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="49999" data-brand="apple">
                    <img src="i phone 16e.webp" alt="i phone 16e">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile9.php" target="_blank" style="text-decoration: none; color: black;">Apple iPhone 16e (White, 128 GB)</a></div>
                        <div class="product-price">Starting from ₹2,083/m or ₹49,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="9"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="35999" data-brand="nothing">
                    <img src="nothing phone 2.jpg" alt="nothing phone 2">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile10.php" target="_blank" style="text-decoration: none; color: black;">Nothing Phone (2) 5G (Grey, 12GB RAM, 512GB Storage)</a></div>
                        <div class="product-price">Starting from ₹1,499/m or ₹35,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="10"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="25999" data-brand="Realme">
                    <img src="Realme 14 Pro Plus.webp" alt="Realme 14 Pro Plus">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile11.php" target="_blank" style="text-decoration: none; color: black;">realme 14 Pro+ 5G (Pearl White, 256 GB)  (12 GB RAM)</a></div>
                        <div class="product-price">Starting from ₹1,083/m or ₹25,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="11"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                <div class="product-card"data-price="2999" data-brand="Samsung">
                    <img src="SAMSUNG Galaxy S21 FE.webp" alt="SAMSUNG Galaxy S21 FE">
                    <div class="product-info">
                        <div class="product-title"><a href="mobile12.php" target="_blank" style="text-decoration: none; color: black;">SAMSUNG Galaxy S21 FE 5G (Lavender, 128 GB)  (8 GB RAM)</a></div>
                        <div class="product-price">Starting from ₹1,249/m or ₹29,999</div>
                        <form action="add_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="12"> <!-- Ensure this ID matches actual product -->
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <p>&copy; 2025 Refurbmate. All rights reserved.</p>
                <p>Developed By: Gaurav</p>
            </div>
            <div class="footer-center">
                <ul>
                <li><a href="phone.php">Home</a></li>
                    <li><a href="about_us.php">About</a></li>
                    <li><a href="phone.php">Contact</a></li>
                    <li><a href="about_us.php">Privacy Policy</a></li>
                    <p>Customer Support and Service Center 80008585
                    </p>
                </ul>
            </div>
            <div class="footer-right">
                <p>Follow us:</p>
                <a href="https://www.facebook.com" target="_blank">Facebook</a> |
                <a href="https://twitter.com" target="_blank">Twitter</a> |
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
            </div>
        </div>
    </footer>
    <script>
        function filterProducts() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const priceFilter = document.getElementById('priceFilter').value;
            const brandFilter = document.getElementById('brandFilter').value;
            const productGrid = document.getElementById('productGrid');
            const productCards = productGrid.getElementsByClassName('product-card');
            
            for (let i = 0; i < productCards.length; i++) {
                const title = productCards[i].getElementsByClassName('product-title')[0].textContent.toLowerCase();
                const price = parseInt(productCards[i].getAttribute('data-price'));
                const brand = productCards[i].getAttribute('data-brand');
                
                let display = true;
                
                // Check if the title matches the search input
                if (searchInput && !title.includes(searchInput)) {
                    display = false;
                }
                
                // Check if the price falls within the selected range
                if (priceFilter !== 'all') {
                    const [min, max] = priceFilter.split('-').map(Number);
                    if (max) {
                        if (price < min || price > max) {
                            display = false;
                        }
                    } else if (price < min) {
                        display = false;
                    }
                }
                
                // Check if the brand matches the selected brand
                if (brandFilter !== 'all' && brand !== brandFilter) {
                    display = false;
                }
                
                // Display or hide the product card based on the filters
                productCards[i].style.display = display ? "block" : "none";
            }
        }

        // Add event listeners for search input and filters
        document.getElementById('searchInput').addEventListener('keyup', filterProducts);
        document.getElementById('priceFilter').addEventListener('change', filterProducts);
        document.getElementById('brandFilter').addEventListener('change', filterProducts);
    </script>
</body>
</html>