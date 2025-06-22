<?php
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /");
    exit();
}
?>


<?php
require_once "./database.php";

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
if ($search !== '') {
    $sql = "SELECT * FROM products WHERE product_name LIKE :search";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => '%' . $search . '%']);
    $all_product = $stmt;
} else {
    $sql = "SELECT * FROM products";
    $all_product = $pdo->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="shop.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="/styling/nav.css">
    <link rel="stylesheet" href="/styling/footer.css">

    <script src="shop.js"></script>
    <title>Trang sản phẩm</title>
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
                    <li><i class="fa-solid fa-cart-shopping" onclick="window.location.href='../cart-page/cart.php'"></i></li>
                    <li><i class="fa-solid fa-circle-user" onclick="toggleMenu()"></i></li>
                  </ul>

                  <!-- Mobile Buttons -->
                  <ul class="user-buttons">
                    <li><a href="../cart-page/cart.php"><button>Cart</button></a></li>
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

        <div class="section-title">
            <form method="get" action="" class="search-form">
                <input type="text" name="search" placeholder="Search..."
                    value="<?php echo htmlspecialchars($search); ?>" class="search-input">
                <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
            </form>
            <h2>Our Products</h2>
        </div>

        <main>
            <?php if ($all_product->rowCount() == 0): ?>
                <p class="no-results">Cannot find any product in stock.</p>
            <?php endif; ?>

            <?php while ($row = $all_product->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="card">
                    <div class="wishlist"><i class="fa-regular fa-heart"></i></div>
                    <div class="image">
                        <img src="img/<?php echo htmlspecialchars($row["image_url"]); ?>" alt="">
                    </div>
                    <div class="caption">
                        <p class="productname">
                            <a href="product_details.php?id=<?php echo $row['id']; ?>">
                                <?php echo htmlspecialchars($row['name']); ?>
                            </a>
                        </p>
                        <p class="price-new">$<?php echo number_format($row["price"], 2); ?></p>
                        <!-- Remove discount/old price if it no longer exists -->
                        <!-- <p class="rating"><i class="fa-solid fa-star"></i> 4.8</p> -->
                        <div class="action-row">
                            <form action="/Pages/shop-page/add-to-cart.php" method="post" style="display:inline;" class="cart-form">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="cart-btn" ><i class="fa-solid fa-cart-plus"></i></button>
                            </form>
                            <div class="popup">Item added to cart!</div> 
                            <button class="buy-btn">BUY +</button>
                        </div>

                    </div>
                </div>
            <?php } ?>
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
document.querySelectorAll(".cart-form").forEach(form => {
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const popup = this.closest(".card").querySelector(".popup");
    popup.classList.add("show");

    setTimeout(() => {
      popup.classList.remove("show");
    }, 1000);

    // Prepare form data
    const formData = new FormData(this);

    // Send it via AJAX
    fetch(this.action, {
      method: this.method,
      body: formData
    })
    .then(response => response.text()) // or .json() if your server returns JSON
    .then(data => {
      console.log("Success:", data);
      // You can update the UI here if needed
    })
    .catch(error => {
      console.error("Error:", error);
    });
  });
});
</script>

</body>

</html>