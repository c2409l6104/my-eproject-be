<?php
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: /");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styling/nav.css">
    <link rel="stylesheet" href="/Pages/about-page/about-page.css">
    <link rel="stylesheet" href="/styling/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
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
    <main class="about-main">
        <section class="hero">
            <h1>Who We Are</h1>
            <p>Eco Clothes is more than a brand — it’s a movement toward responsible fashion, sustainability, and ethical design.</p>
        </section>

        <section class="mission">
            <h2>Our Mission</h2>
            <p>We create stylish, sustainable apparel that empowers conscious consumers. Every product we craft reduces environmental impact and supports ethical labor.</p>
        </section>

        <section class="values">
            <h2>Core Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <i class="fa-solid fa-leaf"></i>
                    <h3>Sustainability</h3>
                    <p>Eco-friendly fabrics, ethical production, and a commitment to zero waste.</p>
                </div>
                <div class="value-card">
                    <i class="fa-solid fa-users"></i>
                    <h3>Ethical Sourcing</h3>
                    <p>We partner with fair-trade certified suppliers and transparent labor practices.</p>
                </div>
                <div class="value-card">
                    <i class="fa-solid fa-shirt"></i>
                    <h3>Quality & Style</h3>
                    <p>Timeless, modern designs made to last and crafted with purpose.</p>
                </div>
            </div>
        </section>

        <section class="team">
            <h2>Meet the Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="/Pages/resources/team1.jpg" alt="Alex Green">
                    <h4>Alex Green</h4>
                    <p>Founder & CEO</p>
                </div>
                <div class="team-member">
                    <img src="/Pages/resources/team2.jpg" alt="Sophia Earth">
                    <h4>Sophia Earth</h4>
                    <p>Creative Director</p>
                </div>
                <div class="team-member">
                    <img src="/Pages/resources/team3.jpg" alt="Mason Wood">
                    <h4>Mason Wood</h4>
                    <p>Head of Sustainability</p>
                </div>
                <div class="team-member">
                    <img src="/Pages/resources/team3.jpg" alt="Mason Wood">
                    <h4>Mason Wood</h4>
                    <p>Head of Sustainability</p>
                </div>
                <div class="team-member">
                    <img src="/Pages/resources/team3.jpg" alt="Mason Wood">
                    <h4>Mason Wood</h4>
                    <p>Head of Sustainability</p>
                </div>
            </div>
        </section>

        <section class="testimonial-section">
            <h2>What Our Customers Are Saying</h2>
            <div class="testimonial-container">
                <div class="testimonial-card">
                    <p>"Eco Clothes has changed the way I shop. I feel great wearing clothes that align with my values!"</p>
                    <h4>— Sarah L., California</h4>
                </div>
                <div class="testimonial-card">
                    <p>"The quality is amazing, and I love knowing the materials are sustainably sourced."</p>
                    <h4>— James N., New York</h4>
                </div>
                <div class="testimonial-card">
                    <p>"Fast delivery, beautiful packaging, and the clothes fit perfectly. I'm a regular now!"</p>
                    <h4>— Minh T., Vietnam</h4>
                </div>
            </div>
        </section>

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
</body>

</html>