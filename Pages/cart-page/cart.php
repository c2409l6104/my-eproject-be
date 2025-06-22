<?php
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /");
    exit();
}
require_once "../login-page/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login-page/login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$total = 0;

$sql = "SELECT p.name, p.price, c.quantity, p.id AS product_id
        FROM carts c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/nav.css">
    <link rel="stylesheet" href="/Pages/cart-page/cart.css">
    <link rel="stylesheet" href="/styling/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body>
    <div id='wrapper'>
    <header>    
        <nav class="nav">
            <div class="logo-container">
              <img src="/Pages/resources/Frame 1 (2).svg" alt="Logo" class="logo">
              <h2>Eco Clothes</h2>
            </div>
          
            <ul id="nav-menu">
                <li><i onclick="toggleMenuMobile()" id="close-menu" class="fa-solid fa-xmark"></i></li>
                <li><a href="/">Home</a></li>
                <li><a href="/Pages/shop-page/shop.php">Shop</a></li>
                <li><a href="/Pages/about-page/about-page.php">About</a></li>
                <li><a href="/Pages/contact-page/contact.php">Contact</a></li>
            </ul>
            <div class="icon-container">
                <i class="fa-solid fa-user" onclick="toggleLogin()"></i>
                <div class="hamburger" onclick="toggleMenuMobile()">☰</div>
            </div>
              
            <div class="login-signup-container">
                <?php if (!isset($_SESSION["user"])): ?>
                    <div><i onclick="toggleLogin()" id="close-menu" class="fa-solid fa-xmark"></i></div>
                    <button id="signup" onclick="window.location.href='./Pages/login-page/registration.php'">Sign up</button>
                    <button id="login" onclick="window.location.href='./Pages/login-page/login.php'">Log in</button>
                <?php else: ?>
                <div class="user-menu">
                  <div><i onclick="toggleLogin()" id="close-menu" class="fa-solid fa-xmark"></i></div>

                  <!-- Desktop Icons -->
                  <ul class="user-icons">
                    <li><i class="fa-solid fa-cart-shopping" onclick="window.location.href='./Pages/cart-page/cart.php'"></i></li>
                    <li><i class="fa-solid fa-circle-user" onclick="toggleMenu()"></i></li>
                  </ul>

                  <!-- Mobile Buttons -->
                  <ul class="user-buttons">
                    <li><a href="./Pages/cart-page/cart.php"><button>Cart</button></a></li>
                    <li><a href="/profile.php"><button>Profile</button></a></li>
                    <li><a href="?logout=true"><button>Logout</button></a></li>
                  </ul>

                  <ul id="user-dropdown" class="dropdown-content">
                    <li><a href="/profile.php" id='profile'>Profile</a></li>
                    <li><a href="?logout=true" id='logout'>Logout</a></li>
                  </ul>
                </div>

                <?php endif; ?>
            </div>
          </nav>
    </header>
        <main>
            <div id='cart'>
                <div id='cart-info'>
                    <div id='product-numbering'>
                        <h3>Shopping Cart</h3>
                        <p>Items in your cart: <span id="product-count"><?php echo count($cartItems); ?></span></p>
                    </div>
                    <div id="cart-items">
                        <table >
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($cartItems as $item):
                                $itemTotal = $item['price'] * $item['quantity'];
                                $total += $itemTotal;
                            ?>
                                <tr>
                                    <td data-label='Product'><?= htmlspecialchars($item['name']) ?></td>
                                    <td data-label='Price'>$<?= number_format($item['price'], 2) ?></td>
                                    <td >
                                        <form action="update_quantity.php" method="post" class="quantity-form">
                                            <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                                            <button type="button" class="change-qty" data-action="decrease">−</button>
                                            <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="quantity-input">
                                            <button type="button" class="change-qty" data-action="increase">+</button>
                                        </form>

                                    </td>
                                    <td class='item-total'>$<?= number_format($itemTotal, 2) ?></td>
                                    <td>
                                        <form action='remove_from_cart.php' method='post'>
                                            <input type='hidden' name='product_id' value='<?= $item['product_id'] ?>'>
                                            <button class='remove-item'>Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                </div>
                <div id="checkout">
                    <h2>Total: $<?php echo number_format($total, 2); ?></h2>

                    <button id="checkout-button">Checkout</button>
                    <button id="continue-shopping">Continue Shopping</button>
                </div>
            </div>
        </main>
        <div id='footer'>
            <div class='footer-container'>
                <div class='logo-container' id="footer-logo-container">
                    <img src="/Pages/resources/Frame 1 (1).svg" alt="Logo" class="logo">
                    <h2>Eco Clothes</h2>
                </div>
                <div class='footer-socials'>
                    <a href="https://facebook.com/ecoclothes" target="_blank"><i class="fab fa-facebook-f footer-icon"></i></a>
                    <a href="https://twitter.com/ecoclothes" target="_blank"><i class="fab fa-twitter footer-icon"></i></a>
                    <a href="https://instagram.com/ecoclothes" target="_blank"><i class="fab fa-instagram footer-icon"></i></a>
                    <a href="https://linkedin.com/company/ecoclothes" target="_blank"><i class="fab fa-linkedin-in footer-icon"></i></a>
                </div>
            </div>
        </div>
    </div>
    <script src='/scripts/cart.js'></script>
    <script>
        function toggleMenuMobile() {
            document.getElementById('nav-menu').classList.toggle('active');
            console.log("Menu toggled");
        }

        function toggleLogin() {
            const loginContainer = document.querySelector('.login-signup-container');
            loginContainer.classList.toggle('active');
            console.log("Login toggled");
        }

        function toggleMenu() {
            const userDropdown = document.getElementById('user-dropdown');
            userDropdown.classList.toggle('active');
            console.log("User menu toggled");
        }
    </script>
    <script>
        document.querySelectorAll('.change-qty').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const input = form.querySelector('.quantity-input');
                let value = parseInt(input.value);

                if (this.dataset.action === 'increase') {
                    input.value = value + 1;
                } else if (this.dataset.action === 'decrease' && value > 1) {
                    input.value = value - 1;
                }

                form.submit(); // auto-submit right after quantity change
            });
        });
    </script>
</body>

</html>