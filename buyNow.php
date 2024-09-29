<?php
session_start();
$isLoggedIn = isset($_SESSION['Usname']);
$username = $isLoggedIn ? $_SESSION['Usname'] : '';
$userId = $isLoggedIn ? $_SESSION['customerID'] : null;
$productId = isset($_GET['id']) ? $_GET['id'] : '';

// Include database connection
include 'connect.php';

// Initialize product name
$productName = '';

if ($productId) {
    // Fetch product name from database
    $sql = "SELECT Clenser_name FROM clenser WHERE Cl_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $productId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $productName);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Include Bootstrap's JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <title>Buy Now</title>
    
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: #333;
            color: #fff;
            padding: 1rem 0;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 1.5rem;
            font-size: 24px;
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="text"] {
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus {
            border-color: #007BFF;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        button {
            padding: 0.8rem;
            background: #007BFF;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
            margin-top: 2rem;
        }
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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

                    <a href="cart.php" class="btn">Cart</a>
                    <a href="logout.php" class="btn">Log Out</a>
                <?php else: ?>
                    <a href="Signin.php" class="btn">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
    <main>
        <h1>Purchase Form</h1>
        <form id="purchase-form">
            <label for="productname">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($productName); ?>">

            <label for="name">Quantity:</label>
            <input type="text" id="quantity" name="quantity" required><br>
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            
            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" required><br>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            
            
            <button type="submit">Submit</button>
        </form>

        <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
        <script>
            (function() {
                emailjs.init('0dC8U10tkq7mtNRcK');
            })();

            document.getElementById('purchase-form').addEventListener('submit', function(event) {
    event.preventDefault();

    emailjs.sendForm('service_x71pvhm', 'template_b0qx4am', this)
        .then(function(response) {
            // Redirect to thank_you.php on success
            window.location.href = 'thank_you.php';
        }, function(error) {
            alert('Failed to send message: ' + error.text);
        });
});
        </script>
    </main>

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
</body>
</html>
