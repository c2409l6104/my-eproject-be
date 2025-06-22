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
  <link rel="stylesheet" href="/Pages/contact-page/contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../../styling/nav.css">
  <link rel="stylesheet" href="../../styling/footer.css">


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
  <div class="contact-page">
    <div class="contact-header">
      <h1>GET IN TOUCH</h1>
      <p class="subheading">Visit one of our agency locations or contact us today</p>
    </div>

    <div class="contact-content">
      <!-- Left Column - Contact Info -->
      <div class="contact-info">
        <div class="location-card">
          <h3>Head Office</h3>
          <div class="contact-details">
            <p><i class="fas fa-map-marker-alt"></i> 347 Đ. Quang Trung, Cầu Giấy, Hà Nội, Việt Nam</p>
            <p><i class="fas fa-envelope"></i> support@ecoclothes.com</p>
            <p><i class="fas fa-phone"></i> +84 123 456 789</p>
            <p><i class="fas fa-clock"></i> Monday to Saturday: 9:00 AM to 6:00 PM</p>
          </div>
        </div>

        <div class="location-card">
          <h3>University Branch</h3>
          <div class="contact-details">
            <p><i class="fas fa-map-marker-alt"></i> 123 University Ave, Hanoi, Vietnam</p>
            <p><i class="fas fa-envelope"></i> university@ecoclothes.com</p>
            <p><i class="fas fa-phone"></i> +84 987 654 321</p>
            <p><i class="fas fa-clock"></i> Monday to Friday: 10:00 AM to 5:00 PM</p>
          </div>
        </div>
      </div>

      <!-- Right Column - Map -->
      <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.191494787133!2d105.77481507614914!3d21.065012586530653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134552b9bd05513%3A0x3e09a5ab457a8228!2zTmcuIDM0NyDEkC4gQ-G7lSBOaHXhur8sIEPhu5UgTmh14bq_IDIsIELhuq9jIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1750106645517!5m2!1svi!2s"
          width="100%"
          height="500"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>

    <!-- Team Section -->
    <!-- <div class="team-section">
      <h2>Meet Our Team</h2>
      <div class="team-grid">
        <div class="team-member">
          <img src="/Pages/resources/team1.jpg" alt="Anna Tran">
          <h3>Anna Tran</h3>
          <p>Customer Support Lead</p>
          <p><i class="fas fa-envelope"></i> anna@ecoclothes.com</p>
        </div>
        <div class="team-member">
          <img src="/Pages/resources/team1.jpg" alt="Anna Tran">
          <h3>Anna Tran</h3>
          <p>Customer Support Lead</p>
          <p><i class="fas fa-envelope"></i> anna@ecoclothes.com</p>
        </div>
        <div class="team-member">
          <img src="/Pages/resources/team1.jpg" alt="Anna Tran">
          <h3>Anna Tran</h3>
          <p>Customer Support Lead</p>
          <p><i class="fas fa-envelope"></i> anna@ecoclothes.com</p>
        </div>
        <div class="team-member">
          <img src="/Pages/resources/team2.jpg" alt="David Nguyen">
          <h3>David Nguyen</h3>
          <p>Marketing Manager</p>
          <p><i class="fas fa-envelope"></i> david@ecoclothes.com</p>
        </div>
        <div class="team-member">
          <img src="/Pages/resources/team3.jpg" alt="Lisa Pham">
          <h3>Lisa Pham</h3>
          <p>Design Coordinator</p>
          <p><i class="fas fa-envelope"></i> lisa@ecoclothes.com</p>
        </div>
      </div>
    </div> -->

    <!-- Contact Form -->
    <div class="contact-form-section">
      <h2>Send Us a Message</h2>
      <form class="message-form">
        <div class="form-group">
          <input type="text" placeholder="Your Name" required>
        </div>
        <div class="form-group">
          <input type="email" placeholder="Your Email" required>
        </div>
        <div class="form-group">
          <textarea placeholder="Your Message" rows="5" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Submit Message</button>
      </form>
    </div>
  </div>

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