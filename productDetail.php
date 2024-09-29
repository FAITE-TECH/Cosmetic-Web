<?php
session_start();
$isLoggedIn = isset($_SESSION['Usname']);
$username = $isLoggedIn ? $_SESSION['Usname'] : '';
$userId = $isLoggedIn ? $_SESSION['customerID'] : null; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <link rel="icon" href="Logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Include Bootstrap's JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <style>
        .product-container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            margin: 30px ;
            background-color: #fff;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            justify-content: center;
           
        }

        .product-image {
            flex: 1;
            text-align: center;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .product-details {
            flex: 2;
            padding: 20px;
        }

        .product-details h1 {
            margin-top: 0;
            font-size: 2em;
            color: #343a40;
        }

        .product-details p {
            font-size: 1.1em;
            margin: 10px 0;
        }

        .button-container {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #84c32f;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            display: inline-block;
        }

        .btn:hover {
            background-color: #6dbd1f;
        }

        @media (max-width: 768px) {
            .product-container {
                flex-direction: column;
                align-items: center;
            }

            .product-image,
            .product-details {
                flex: none;
                width: 100%;
            }

            .product-details {
                padding: 10px;
            }

            .button-container {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body style="background-color: #255269;">
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

    <div class="container product-container">
        <?php
        include 'connect.php';

        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            $sql = "SELECT * FROM clenser WHERE Cl_ID = $productId";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo '<div class="product-image">';
                echo '<img src="uploads/' . $row['image'] . '" alt="' . $row['Clenser_name'] . '">';
                echo '</div>';
                echo '<div class="product-details">';
                echo '<h1>' . $row['Clenser_name'] . '</h1>';
                echo '<p><strong>Price:</strong> Rs. ' . $row['Clenser_price'] . '</p>';
                echo '<p><strong>Size:</strong> ' . $row['Clenser_size'] . '</p>';

                echo '<div class="button-container">';
                if ($isLoggedIn) {
                    echo '<form action="addToCart.php" method="POST">';
                    echo '<input type="hidden" name="product_id" value="' . $row['Cl_ID'] . '">';
                    echo '<input type="hidden" name="user_id" value="' . $userId . '">';
                    echo '<input type="hidden" name="p_name" value="' . $row['Clenser_name'] . '">';
                    echo '<input type="hidden" name="price" value="' . $row['Clenser_price'] . '">';
                    echo '<input type="hidden" name="size" value="' . $row['Clenser_size'] . '">';
                    echo '<input type="hidden" name="image" value="' . $row['image'] . '">';
                    echo '<button type="submit" class="btn">Add to Cart</button>';
                    echo '</form>';
                } else {
                    echo '<a href="Signin.php" class="btn">Log in to add to cart</a>';
                }

                echo '<a href="buyNow.php?id=' . $row['Cl_ID'] . '" class="btn">Buy Now</a>';
                echo '</div>';

                echo '</div>';
            } else {
                echo '<p>Product not found.</p>';
            }
        } else {
            echo '<p>No product ID provided.</p>';
        }

        mysqli_close($conn);
        ?>
    </div>

    <footer>
        <div class="container footer-container">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Skinvia is your go-to source for premium skin care products and treatments.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="<?php echo $isLoggedIn ? 'CusHome.php' : 'index.php'; ?>">Home</a></li>
                    <li><a href="Product.php">Products</a></li>
                    <li><a href="About.php">About</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">LinkedIn</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Email: info@skinvias.com</p>
                <p>Phone: +94 76 5644323</p>
            </div>
        </div>
    </footer>
</body>
</html>

