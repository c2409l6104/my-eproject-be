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
    <title>Eco Clothes Navigation</title>
    <link rel="stylesheet" href="/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="/styling/about.css">
    <link rel="stylesheet" href="/styling/carousel.css">
    <link rel="stylesheet" href="/styling/shop-preview.css">
    <link rel="stylesheet" href="/styling/footer.css">
    <link rel="stylesheet" href="/styling/call-to-action.css">
    <link rel="stylesheet" href="/styling/contact.css">
    <link rel="stylesheet" href="/styling/nav.css">
    <link rel="stylesheet" href="/styling/bot.css">


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
                    <li><i class="fa-solid fa-cart-shopping" onclick="window.location.href='./Pages/cart-page/cart.php'"></i></li>
                    <li><i class="fa-solid fa-circle-user" onclick="toggleMenu()"></i></li>
                  </ul>

                  <!-- Mobile Buttons -->
                  <ul class="user-buttons">
                    <li><a href="./Pages/cart-page/cart.php"><button>Cart</button></a></li>
                    <li><a href="./Pages/login-page/profile.php"><button>Profile</button></a></li>
                    <li><a href="?logout=true"><button>Logout</button></a></li>
                  </ul>

                  <ul id="user-dropdown" class="dropdown-content">
                    <li><a href="./Pages/login-page/profile.php" id='profile'>Profile</a></li>
                    <li><a href="?logout=true" id='logout'>Logout</a></li>
                  </ul>
                </div>

                <?php endif; ?>
            </div>
          </nav>
    </header>
      
    <div id="Home">
        <div class="home-container">
          <div id="home-text" class="special-gothic-expanded-one-regular">
            <h1>Discover our latest collection of sustainable fashion. Shop now and make a difference!</h1>
            <p>Explore our latest collection—timeless designs, premium fabrics, and effortless style for every occasion. Dress up or keep it casual with confidence.</p>
            <div id="shop-button-container">
              <a href="./Pages/shop-page/shop.php"><button id="shop-button">Shop Now!</button></a>
            </div>
          </div>
          <img src="./Pages/resources/model2-removebg.png" alt="Home Page Image" class="home-image" />
        </div>
      </div>
      
    <!-- new section -->
    <div id="collection">
        <div class="collection-container1">
          <h1>Featured Collection</h1>
          <div class="carousel-container">
            <div class="carousel">
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="Featured Product">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/Hip Hop T-Shirt Men Streetwear Japanese Kanji Funny Cat Printed T Shirt 2022 Men Harajuku Cotton.jpeg" alt="Featured Product">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg" alt="Featured Product">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="Featured Product">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg" alt="Featured Product">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="Featured Product">
              </div>
              <!-- More items -->
            </div>
            <div class="dots-container"></div>
          </div>
        </div>
      
        <div class="collection-container2">
          <h1>New Arrivals</h1>
          <div class="carousel-container">
            <div class="carousel">
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="New Arrival">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="New Arrival">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="New Arrival">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="New Arrival">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="New Arrival">
              </div>
              <div class="carousel-item">
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="New Arrival">
              </div>
              <!-- More items -->
            </div>
            <div class="dots-container"></div>
          </div>
        </div>
      </div>
      
    <!-- new section -->
    <div id="about">
        <div class='about-container'>
            <img src="./Pages/resources/pexels-pixabay-264726.jpg"/>
            <div class='about-text'>
                <h1>Wear the Change. Shop Sustainable Today</h1>
                <p>Eco Clothes is dedicated to sustainable fashion that looks great and feels even better. With a commitment to ethical practices and transparency, we create stylish clothing that cares for both people and the planet. Join us in making a positive impact—one outfit at a time.</p>
                <button id="discover-button">Discover Your Perfect Outfit</button>
            </div>
        </div>
    </div>
    <!-- new section -->
    <div id="shop-preview">
        <div id='shop-preview-container1'>
            <h1>Shop by category</h1>
            <button>
                <a href="/shop">View All</a>
            </button>
        </div>
        <div id='shop-preview-container2'>
            <div class='shop-preview-item' id='shop-preview-item1'>
                <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" alt="Shop Item 1">
                <h2>Retro Japanese T-Shirt</h2>
            </div>
            <div class='shop-preview-item' id='shop-preview-item2'>
                <img src="./Pages/resources/Hip Hop T-Shirt Men Streetwear Japanese Kanji Funny Cat Printed T Shirt 2022 Men Harajuku Cotton.jpeg">
                <h2>Vintage Cotton T-Shirt</h2>
            </div>
            <div class='shop-preview-item' id='shop-preview-item3'>
                <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg">
                <h2>Vintage Cotton T-Shirt</h2>
            </div>
        </div>
    </div>
    <!-- new section -->
    <div id="call-to-action">
        <div class='text-container'>
            <h1>
                Save up to 50% on your first order!<br>
                Sign up for exclusive offers and updates.
            </h1>
        </div>
        <div class='button-container'>
            <button id="cta-button">Sign Up Now</button>
        </div>
    </div>

<!-- new section -->
<!-- Contact Section -->
<div id="contact">
    <div class="contact-container">
      <h1>Contact Us</h1>
      <p>We’re here to help! Reach out to us through any of the following channels or visit us in person.</p>
  
      <div class="contact-info-boxes">
        <div class="info-box">
          <i class="fa-solid fa-store"></i>
          <h3>Our Store</h3>
          <p>123 Eco Street, Green City, Earth 00001</p>
        </div>
  
        <div class="info-box">
          <i class="fa-solid fa-phone"></i>
          <h3>Phone</h3>
          <p>+1 (555) 123-4567</p>
        </div>
  
        <div class="info-box">
          <i class="fa-solid fa-envelope"></i>
          <h3>Email</h3>
          <p>support@ecoclothes.com</p>
        </div>
  
        <div class="info-box">
          <i class="fa-solid fa-clock"></i>
          <h3>Business Hours</h3>
          <p>Mon - Fri: 9:00 AM - 6:00 PM</p>
          <p>Sat - Sun: Closed</p>
        </div>
  
        <div class="info-box">
          <i class="fa-brands fa-instagram"></i>
          <h3>Follow Us</h3>
          <p>
            <a href="https://instagram.com/ecoclothes" target="_blank">Instagram</a><br>
            <a href="https://facebook.com/ecoclothes" target="_blank">Facebook</a><br>
            <a href="https://twitter.com/ecoclothes" target="_blank">Twitter</a>
          </p>
        </div>
      </div>
    </div>
  </div>

    <div id="chatbot-widget">
    <button id="chat-toggle"><i class="fa-solid fa-comments"></i></button>

    <div id="chat-window" class="hidden">
      <div class="chatbox">
        <div class="header">
          <h3>Ask Eco Clothes AI</h3>
          <!-- <div class="close"><i class="fa-solid fa-xmark"></i></div> -->
        </div>

        <div class="reply" id="chat-log"></div>

        <div class="input-area">
          <textarea id="userInput" rows="3" placeholder="Type your message..." required></textarea>
          <button id="sendBtn" type="button">Send</button>
        </div>
      </div>
    </div>
  </div>
     <!-- Footer Section -->
  <div id='footer'>
        <div class='footer-container'>
          <div class='logo-container' id="footer-logo-container">
            <img src="Pages/resources/Frame 1 (1).svg" alt="Logo" class="logo">
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
    document.getElementById("chat-toggle").addEventListener("click", () => {
      document.getElementById("chat-window").classList.toggle("hidden");
      
    });

    document.getElementById("sendBtn").addEventListener("click", async () => {
      const input = document.getElementById("userInput");
      const message = input.value.trim();
      if (!message) return;

      const chatLog = document.getElementById("chat-log");

      const userMsg = document.createElement("div");
      userMsg.innerHTML = `<strong>You:</strong><br>${message}`;
      chatLog.appendChild(userMsg);

      input.value = "";

      try {
        const res = await fetch("chatbot_api.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ prompt: message })
        });

        const data = await res.json();

        const aiMsg = document.createElement("div");
        aiMsg.innerHTML = `<strong>AI:</strong><br>${data.reply || data.error || "No reply"}`;
        chatLog.appendChild(aiMsg);
        chatLog.scrollTop = chatLog.scrollHeight;

      } catch (err) {
        alert("Error: " + err.message);
      }
    });
  </script>
<script src="index.js" type="module"></script>
<script src="/scripts/carousel.js" type="module"></script>
<script>
    function toggleMenuMobile() {
      document.getElementById('nav-menu').classList.toggle('active');
      console.log("Menu toggled");
    }
    function toggleLogin(){
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

