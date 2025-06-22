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
    <title>Document</title>
    <link rel="stylesheet" href="/Pages/product-page/page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.css"> -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Inter:wght@400;600&display=swap"
        rel="stylesheet">
    <link href='https://cdn.boxicons.com/fonts/brands/boxicons-brands.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../styling/nav.css" >
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
    <main>
        <div class="guide-popup">
            <div class="popup-container">
                <button id="close-button">x</button>
            
                <div class="popup-guide">
                    <img src="/eproject-php-main/img/t-shirt-size-chart-template-with-instructions.jpg" alt="">
                </div>
            </div>
        </div>

        <div class="main-item">
            <!-- Include Product Gallery -->
            <div class="product-gallery">
                <div class="main-image-container">
                    <img id="mainImage" src="/eproject-php-main/img/IMG_9184.PNG" alt="Main Image" class="main-image">
                </div>

                <div id="product-gallery" class="thumbnail-gallery">
                    <img src="/eproject-php-main/img/images.jpeg" class="thumb" alt="Product Image">
                    <img src="/eproject-php-main/img/IMG_9184.PNG" class="thumb" alt="Product Image">
                    <img src="/eproject-php-main/img/images.jpeg" class="thumb" alt="Product Image">
                    <img src="/eproject-php-main/img/IMG_9184.PNG" class="thumb" alt="Product Image">
                    <img src="/eproject-php-main/img/IMG_9184.PNG" class="thumb" alt="Product Image">
                </div>
            </div>

            <!-- Include Product Info -->
            <div class="product-info">
                <h1 class="product-title">INSSA [BH 1 Năm] Chảo vuông Chảo chống dính đáy chiên trứng 18cm phong cách
                    Nhật Bản cuộn Chảo ăn
                    sáng GUOJ037</h1>
                <div class="main-rating">
                    <span class="stars">5.0 <span> <i class='bx  bxs-star'
                            style='color:#fff200'></i> <i class='bx  bxs-star' style='color:#fff200'></i> <i
                            class='bx  bxs-star' style='color:#fff200'></i> <i class='bx  bxs-star'
                            style='color:#fff200'></i> <i class='bx  bxs-star' style='color:#fff200'></i> </span></span>
                    <span class="votes" >69 Votes</span> 
                </div>
                <div class="main-price">
                    <h2 class="current-price"><span style="color: #ff0000;">$19.99</span></h2>
                    <h3 class="original-price"><span style="text-decoration: line-through;">$24.99</span></h3>
                </div>
                <div class="size-select">
                    <label>Select Size:</label>
                    <div class="size-list">
                        <button class="size-button">S</button>
                        <button class="size-button">M</button>
                        <button class="size-button">L</button>
                        <button class="size-button">XL</button>
                        
                    </div>
                    <button class="size-guide" >Size Guide</button>
                </div>
                <div class="addition">
                    <button class="favourite"><i class='bx  bxs-heart'></i> Wishlist </button>
                    <button class="cart"><i class='bx  bxs-cart'></i> Add to Cart</button>
                </div>
                <div class="item-description">
                    <h3>Description</h3>
                    <p>Chảo chống dính đáy chiên trứng 18cm phong cách Nhật Bản cuộn, chất liệu cao cấp, an toàn cho sức
                        khỏe. Thiết kế tiện lợi, dễ dàng sử dụng và vệ sinh. Phù hợp cho việc nấu ăn hàng ngày.</p>
                </div>
                <div class="item-material">
                    <h3>Material</h3>
                    <ul style="margin-left:20px;list-style: disc;">
                        <li>Chất liệu: Nhôm chống dính cao cấp</li>
                        <li>Đáy từ, phù hợp với bếp từ và bếp gas</li>
                        <li>Không chứa PFOA, an toàn cho sức khỏe</li>
                        <li>Chịu nhiệt tốt, dễ dàng vệ sinh</li>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Include Similar Items -->
        <div class="similar-box">
            <div class="similar-title">
                <h1>Similar Items</h1>
                <p>Explore more products that you might like</p>
            </div>
            
            <div class="product-grid" id="product-grid">

                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/images.jpeg" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>


                </div>
                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/71+3nzpg1aL._AC_UY1000_.jpg" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>


                </div>
                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/71+3nzpg1aL._AC_UY1000_.jpg" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>


                </div>
                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/Sandro_SFPCA00830-13_V_1.webp" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>
                    <!-- <div class="similar">
                        <button class="find-similar">Find similar product</button>
                    </div> -->

                </div>
                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/71+3nzpg1aL._AC_UY1000_.jpg" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>


                </div>
                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/Sandro_SFPCA00830-13_V_1.webp" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>


                </div>
                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/71+3nzpg1aL._AC_UY1000_.jpg" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>


                </div>
                <div class="product-card">
                    <span class="discount">-25%</span>
                    <button class="like-btn"><i class='bx  bx-heart'></i> </button>
                    <div class="product-img">
                        <img src="img/Sandro_SFPCA00830-13_V_1.webp" alt="Eco Product" />
                    </div>
                    <div class="card-details">
                        <h2>Eco White Dress</h2>
                        <div class="item-details">
                            <p class="price">$3.99 <span class="original">$5.99</span></p>
                            <div class="rating"><i class='bx  bx-star'></i> 4.8</div>                                           
                        </div>

                        <div class="buttons">
                            <button class="buy-button">BUY +</button>
                            <a class=" add-to-cart"><i class='bx  bx-cart'></i> </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </main>

    <script src="script.js"></script>
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