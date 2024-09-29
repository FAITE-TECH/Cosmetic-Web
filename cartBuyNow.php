<?php
session_start();
$isLoggedIn = isset($_SESSION['Usname']);
if (!$isLoggedIn || !isset($_SESSION['customerID'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['customerID'];

// Include database connection
include 'connect.php';

// Fetch cart items for the user
$sql = "SELECT * FROM cart WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$cartItems = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = $row;
    }
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <!-- Include Bootstrap's JavaScript and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    
    <!-- Include any additional CSS or libraries here -->
    <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script>
        (function() {
            emailjs.init('0dC8U10tkq7mtNRcK'); // Your EmailJS User ID
        })();
        
        function sendEmail(form) {
            emailjs.sendForm('service_x71pvhm', 'template_ezbd3us', form)
                .then(function(response) {
                    // Redirect to thank_you.php on success
                    window.location.href = 'thank_you.php';
                }, function(error) {
                    alert('Failed to send message: ' + error.text);
                });
        }
    </script>
    <style>
        /* Add your styles here or keep using styles.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #255269;
            color: #333;
            line-height: 1.6;
        }
        header, footer {
            background: #002147;
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
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f8f8;
        }
        label {
            display: block;
            margin-top: 1rem;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 0.8rem;
            margin-top: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            padding: 0.8rem 1.5rem;
            background: #28a745;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #218838;
        }
        .empty-cart {
            text-align: center;
            margin-top: 2rem;
        }
        .empty-cart a {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>
<body>
<header>
    <div class="header-container">
        <div class="logo">
            <img src="Logo/logo.png" alt="Logo">
        </div>
        <nav class="navbar navbar-expand-lg navbar-light">
            <!-- Hamburger icon for mobile view -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation links that will be collapsed into the dropdown -->
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mr-auto"> <!-- Change to mr-auto for left alignment -->
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
                
                <!-- Buttons for login/logout or cart on the right -->
               
            </div>
            <div class="header-buttons">
                    <?php if ($isLoggedIn): ?>
                        <a href="logout.php" class="btn">Log Out</a>
                    <?php else: ?>
                        <a href="Signin.php" class="btn">Log In</a>
                    <?php endif; ?>
                </div>
        </nav>
    </div>
</header>
    <main>
        <h1>Purchase Form</h1>
        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                <p>Your cart is empty.</p>
                <a href="Product.php" class="btn">Go to Products</a>
            </div>
        <?php else: ?>
            <form id="purchase-form" onsubmit="event.preventDefault(); sendEmail(this);">
                <h2>Order Details</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cart_summary = "";
                        $total_amount = 0;
                        foreach ($cartItems as $item):
                            $item_total = $item['price'] * $item['quantity'];
                            $total_amount += $item_total;
                            $cart_summary .= "{$item['p_name']} (Size: {$item['size']}) - {$item['quantity']} x {$item['price']} = {$item_total}\n";
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['p_name']); ?></td>
                                <td><?php echo htmlspecialchars($item['price']); ?></td>
                                <td><?php echo htmlspecialchars($item['size']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($item_total); ?></td>
                            </tr>
                            <!-- Hidden inputs to pass cart items -->
                            <input type="hidden" name="product_ids[]" value="<?php echo htmlspecialchars($item['product_id']); ?>">
                            <input type="hidden" name="product_names[]" value="<?php echo htmlspecialchars($item['p_name']); ?>">
                            <input type="hidden" name="product_prices[]" value="<?php echo htmlspecialchars($item['price']); ?>">
                            <input type="hidden" name="product_sizes[]" value="<?php echo htmlspecialchars($item['size']); ?>">
                            <input type="hidden" name="product_quantities[]" value="<?php echo htmlspecialchars($item['quantity']); ?>">
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <input type="hidden" name="cart_summary" value="<?php echo htmlspecialchars($cart_summary); ?>">
                <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($total_amount); ?>">

                <h2>Your Details</h2>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="mobile">Mobile Number:</label>
                <input type="text" id="mobile" name="mobile" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="4" required></textarea>

                <button type="submit">Submit Order</button>
            </form>
        <?php endif; ?>
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
