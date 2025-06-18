<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="/styling/nav.css">
    <link rel="stylesheet" href="/styling/about.css">
    <link rel="stylesheet" href="/styling/carousel.css">
    <link rel="stylesheet" href="/styling/shop-preview.css">
    <link rel="stylesheet" href="/styling/footer.css">
    <link rel="stylesheet" href="/styling/home.css">
    <link rel="stylesheet" href="/styling/mission.css">
</head>
<body>
    <div id="Navigation">
        <nav>
            <div class="logo-container">
                <img src="Pages/resources/Frame 1 (2).svg" alt="Logo" class="logo">
                <h2>Eco Clothes</h2>
            </div>
            <div>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/shop">Shop</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <div class="login-signup-container">
                <?php if (!isset($_SESSION["user"])): ?>
                    <button id="signup">Sign up</button>
                    <button id="login">Log in</button>
                <?php else: ?>
                    <div class="user-menu">
                        <button id="user-icon" class="user-icon">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul id="user-dropdown" class="dropdown-content">
                            <li><a href="/profile.php">Profile</a></li>
                            <li><a href="?logout=true">Logout</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <div id='Home'>
        <div class='home-container'>
            <div class='special-gothic-expanded-one-regular' id='home-text'>
                <h1>Discover our latest collection of sustainable fashion. Shop now and make a difference!</h1>
                <p>Explore our latest collection—timeless designs, premium fabrics, and effortless style for every occasion. Dress up or keep it casual with confidence.</p>
                <div id='shop-button-container'>
                    <a href='/shop'><button id="shop-button">Shop Now!</button></a>
                </div>
            </div>
            <img src='./Pages/resources/model2-removebg.png' alt='Home Page Image' class='home-image'/> 
        </div>
        <div id='collection'>
            <div class='collection-container1'>
                <h1>Featured Collection</h1>
                <div class="carousel-container">
                    <div class="carousel">
                        <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Hip Hop T-Shirt Men Streetwear Japanese Kanji Funny Cat Printed T Shirt 2022 Men Harajuku Cotton.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Hip Hop T-Shirt Men Streetwear Japanese Kanji Funny Cat Printed T Shirt 2022 Men Harajuku Cotton.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg" class="carousel-item">
                    </div>
                    <div class="dots-container"></div>
                </div>
            </div>
            <div class="collection-container2">
                <h1>New Arrivals</h1>
                <div class="carousel-container">
                    <div class="carousel">
                        <img src="./Pages/resources/2025 New Fashion Trend Cotton Printed T-Shirt Retro Japanese Pattern T-Shirt Short Sleeve Fashion.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Hip Hop T-Shirt Men Streetwear Japanese Kanji Funny Cat Printed T Shirt 2022 Men Harajuku Cotton.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Hip Hop T-Shirt Men Streetwear Japanese Kanji Funny Cat Printed T Shirt 2022 Men Harajuku Cotton.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg" class="carousel-item">
                        <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg" class="carousel-item">
                    </div>
                    <div class="dots-container"></div>
                </div>
            </div>
        </div>
    </div>
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
            <div class='shop-preview-item' id='shop-preview-item2'>
                <img src="./Pages/resources/Japanese Retro Manga Print T-Shirt - Khaki _ XS.jpeg">
                <h2>Vintage Cotton T-Shirt</h2>
            </div>
        </div>
    </div>
    <div id="mission">
        <div class='mission-container'>
            <h1>Our Mission</h1>
            <p>At Eco Clothes, we are dedicated to creating a sustainable future through fashion. Our mission is to provide high-quality, eco-friendly clothing that not only looks good but also makes a positive impact on the environment. We believe in transparency, ethical practices, and empowering our customers to make informed choices about their fashion purchases.</p>
            <button id="learn-more-button">Learn More</button>
        </div>
    </div>
    <div id='footer'>
        <div class='footer-container'>
            <div class='logo-container' id="footer-logo-container">
                <img src="Pages/resources/Frame 1 (1).svg" alt="Logo" class="logo">
                <h2>Eco Clothes</h2>
            </div>
            <div class='footer-socials'>
                <i class="fab fa-facebook-f" class="footer-icon"></i>
                <i class="fab fa-twitter" class="footer-icon"></i>
                <i class="fab fa-instagram" class="footer-icon"></i>
                <i class="fab fa-linkedin-in" class="footer-icon"></i>
            </div>
        </div>
    </div>

    <script src="index.js" type="module"></script>
</body>
</html>

<?php
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>