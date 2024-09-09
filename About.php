<?php
session_start();
$isLoggedIn = isset($_SESSION['Usname']);
$username = $isLoggedIn ? $_SESSION['Usname'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Skin Care</title>
    <link rel="icon" href="Logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
</head>
<body>
<header>
    <div class="container header-container">
        <div class="logo">
            <img src="Logo/logo.png">
        </div>
        <nav>
            <ul>
                <li><a href="<?php echo $isLoggedIn ? 'CusHome.php' : 'index.php'; ?>">Home</a></li>
                <li><a href="Product.php">Products</a></li>
                <li><a href="#">About</a></li>
                <li><a href="contactus.php">Contact</a></li>
            </ul>
        </nav>
        <div class="header-buttons">
                <?php if ($isLoggedIn): ?>
                    <span class="welcome-message">Welcome, <?php echo htmlspecialchars($username); ?></span>
                    <a href="cart.php" class="btn">cart</a>
                    <a href="logout.php" class="btn">Log Out</a>
                    
                <?php else: ?>
                    <a href="Signin.php" class="btn">Log In</a>
                <?php endif; ?>
            </div>
    </div>
</header>

<section class="about-section">
    <div class="container">
        <h2>About Us</h2>
        <div class="about-content">
            <div class="about-text">
                <h3>Discover a Sulosowshadham Flagship</h3>
                <p>Find your ideal combination of in-office treatments & skincare regimens.</p>
                <a href="#" class="read-more">Read more&gt;&gt;</a>
            </div>
            <div class="about-image">
                <img src="uploads/bg4.jpg">
            </div>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <h2>Lorem Ipsum Dolor Sit Amet</h2>
        <div class="services-content">
            <div class="service">
                <span class="service-icon"></span>
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua.</p>
            </div>
            <div class="service">
                <span class="service-icon"></span>
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua.</p>
            </div>
            <div class="service">
                <span class="service-icon"></span>
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua.</p>
            </div>
            <div class="service">
                <span class="service-icon"></span>
                <p>Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua.</p>
            </div>
        </div>
        <div class="additional-content">
            <div class="additional-text">
                <h3>Lorem Ipsum Dolor Sit Amet</h3>
                <p>Consectetur Adipiscing Elit, Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore Magna Aliqua. Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat.</p>
            </div>
            <div class="additional-image">
            <img src="uploads/bg3.jpg">
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer-container">
        <div class="footer-section logo-section">
            <img src="Logo/logo.png" alt="Sulos Owshadham Herbal Health Care Logo">
        </div>
        <div class="footer-section">
            <h3>About us</h3>
            <ul>
                <li><a href="Product.php">Products</a></li>
                <li><a href="contactus.php">Contact us</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Support</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Terms of use</h3>
            <ul>
                <li><a href="#">Privacy policy</a></li>
                <li><a href="#">Customer service</a></li>
                <li><a href="#">Help</a></li>
                <li><a href="#">Support</a></li>
            </ul>
        </div>
        <div class="footer-section subscribe-section">
            <h3>Subscribe</h3>
            <p>Join our mailing to receive updates and offers</p>
            <input type="email" placeholder="Enter your email">
            <button>Subscribe</button>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 Sulos Owshadham Herbal Health Care. All rights reserved.</p>
        <div class="social-icons">
            <a href="#"><img src="Logo/facebook-nb.png" alt="Facebook"></a>
            <a href="#"><img src="Logo/video-nb.png" alt="Instagram"></a>
            <a href="#"><img src="Logo/youtube-nb.png" alt="YouTube"></a>
        </div>
    </div>
</footer>

</body>
</html>
