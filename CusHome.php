<?php
include "connect.php";
session_start();
$isLoggedIn = isset($_SESSION['Usname']);
$username = $isLoggedIn ? $_SESSION['Usname'] : '';

$products_per_page = 3;
$page_number = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page_number - 1) * $products_per_page;

// Fetch total number of products
$sql_total = "SELECT COUNT(*) as total FROM clenser";
$result_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_fetch_assoc($result_total);
$total_products = $row_total['total'];
$total_pages = ceil($total_products / $products_per_page);

// Fetch featured image from database
$sql_featured = "SELECT image_path FROM featured_images";
$result_featured = mysqli_query($conn, $sql_featured);



// Fetch products for the current page
$sql = "SELECT * FROM clenser LIMIT $offset, $products_per_page";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Skin Care</title>
    <link rel="icon" href="Logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .pagination {
        display: flex;
        justify-content: center; /* Center the pagination */
        align-items: center;     /* Align items vertically (optional) */
        margin: 20px 0;          /* Optional margin for spacing */
    }
    </style>

</head>
<body >
<header>
    <div class="header-container">
        <div class="d-flex justify-content-center align-items-center w-100">
            <!-- Logo -->
            <div class="logo">
                <img src="Logo/logo.png" alt="Logo">
            </div>

            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <!-- Inline SVG with green stroke -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 30 30">
                        <path stroke="green" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"/>
                    </svg>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="<?php echo $isLoggedIn ? 'CusHome.php' : 'index.php'; ?>" class="nav-link" style="color: white;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="Product.php" class="nav-link" style="color: white;">Products</a>
                        </li>
                        <li class="nav-item">
                            <a href="About.php" class="nav-link" style="color: white;">About</a>
                        </li>
                        <li class="nav-item">
                            <a href="contactus.php" class="nav-link" style="color: white;">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Buttons -->
            <div class="header-buttons">
                <?php if ($isLoggedIn): ?>
                    <span class="welcome-message">Welcome, <?php echo htmlspecialchars($username); ?></span>
                    <a href="cart.php" class="btn">Cart</a>
                    <a href="logout.php" class="btn">Log Out</a>
                <?php else: ?>
                    <a href="Signin.php" class="btn">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

    <section class="main-banner " style="background-color:#255269 ">
        <div class="banner-container" style="padding: 30px;">
            <div class="banner-content">
                <h2>Care For Your Skin, Care For Your Beauty</h2>
                <p>Sulosowshadham is a distinguished brand in the cosmetic industry, renowned for its commitment to natural beauty and sustainable practices. With a philosophy centered around harnessing the power of nature, Sulosowshadham offers a wide range of products that cater to diverse skin types and beauty needs. </p>
                <a href="About.php" class="" style="color: #FFD700 ;  padding-left:25px;">Learn more</a>
            </div>
            <div class="banner-image">
                <img src="uploads/bg2.jpg">
            </div>
        </div>
    </section>

   
<section class="featured-content"  style="background-color:#255269">
    <div class="container">
        <div class="swiper-container">
            <div class="swiper-wrapper" style="align-items: center;">
                <?php
                if (mysqli_num_rows($result_featured) > 0) {
                    while ($row_featured = mysqli_fetch_assoc($result_featured)) {
                        echo '<div class="swiper-slide">';
                        echo '<div class="featured-image">';
                        echo '<img src="uploads/' . htmlspecialchars($row_featured['image_path']) . '" alt="Featured Image">';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No featured images found.</p>';
                }
                ?>
            </div>

            <!-- Add Pagination -->
            <div class="swiper-pagination" style="align-items: center;"></div>

            <!-- Add Navigation -->
            <br><br>
        </div>
    </div>
</section>

<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });
</script>



    
    <section class="featured-products" style="padding: 30px;">
    <div class="">
    <div class="heading-container">
            <h2>Experience the Power of Rabbit Oil for Healthy Hair Growth</h2>
            <p>Our Rabbit Oil is formulated with 100% natural ingredients, promoting hair growth and preventing hair fall. Discover the secret to luscious, healthy hair today.</p>
        </div>
        <div class="product-grid">
            <div class="product-card">
                <img src="uploads/bg5.jpg" alt="Product 1">
                <h3>Nourish Your Hair with Rabbit Oil for Visible Results</h3>
                <p>Our Rabbit Oil is carefully crafted to provide deep nourishment, resulting in stronger, shinier hair.</p>
                <a href="CustomerClenser.php" class="link">Shop now</a>
            </div>
            <div class="product-card">
                <img src="uploads/bg5.jpg" alt="Product 2">
                <h3>Nourish Your Hair with Rabbit Oil for Visible Results</h3>
                <p>Experience the transformative power of our Rabbit Oil, solving all your hair care concerns.</p>
                <a href="#" class="link">Shop now</a>
            </div>
            <div class="product-card">
                <img src="uploads/bg5.jpg" alt="Product 3">
                <h3>Nourish Your Hair with Rabbit Oil for Visible Results</h3>
                <p>Our Rabbit Oil is a natural solution to revitalize dull and damaged hair, leaving it soft and manageable.</p>
                <a href="#" class="link">Shop now</a>
            </div>
        </div>
    </div>
    <section class="products-footer">
    <div class="">
        <h3>Our Products</h3>
        <p>Discover our range of high-quality herbal cosmetic products.</p>
        <a href="CustomerClenser.php" class="view-all">View all</a>
        
        <div class="row" style="padding-top:20px ;">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-12 col-md-4 mb-3">'; // Column for mobile and desktop
                    echo '<div class="card">'; // Card for styling
                    echo '<img src="uploads/' . htmlspecialchars($row['image']) . '" alt="Product" class="card-img-top">';
                    echo '<div class="card-body">';
                    echo '<h3 class="card-title">' . htmlspecialchars($row['Clenser_name']) . '</h3>';
                    echo '<p class="card-text">' . htmlspecialchars($row['Clenser_price']) . '</p>';
                    echo '<a href="productDetail.php?id=' . $row['Cl_ID'] . '" class="btn btn-primary">Buy Now</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No products found.</p>';
            }
            ?>
        </div>
        
        <div class="pagination">
            <?php if ($page_number > 1): ?>
                <a href="?page=<?php echo $page_number - 1; ?>" class="btn">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" class="btn <?php if ($i == $page_number) echo 'active'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>

            <?php if ($page_number < $total_pages): ?>
                <a href="?page=<?php echo $page_number + 1; ?>" class="btn">Next</a>
            <?php endif; ?>
        </div>
    </div>
</section>


<section class="exclusive-offers">
    <div class="container">
        <div class="text-content">
            <h2>Get Your Exclusive Offers and Updates</h2>
            <p>Sign up for our newsletter to receive exclusive offers and updates.</p>
        </div>
        <div class="btn-group">
            <a href="contactus.php" class="btn btn-primary">Contact us</a>
            <a href="About.php" class="btn btn-secondary">Learn more</a>
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
           <a href="https://www.facebook.com/tamilocean1" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-facebook"></i>
    </a>
    <a href="https://www.instagram.com/sulosowshadham?igsh=YzljYTk1ODg3Zg==" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="https://wa.me/message/WVFLY3HNQOMCB1" target="_blank" rel="noopener noreferrer">
        <i class="fab fa-whatsapp"></i>
    </a>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
</html>