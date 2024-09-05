<?php
include "connect.php";
session_start();
$isLoggedIn = isset($_SESSION['Usname']);
$username = $isLoggedIn ? $_SESSION['Usname'] : '';


// Check if the user is logged in (optional)
if (!isset($_SESSION['Usname'])) {
    header("Location: Signin.php");
    exit();
}

// Handle image deletion
if (isset($_POST['delete_image'])) {
    $image_id = intval($_POST['image_id']);
    
    // Fetch the image path from the database
    $sql_fetch_image = "SELECT image_path FROM featured_images WHERE id = $image_id";
    $result_fetch_image = mysqli_query($conn, $sql_fetch_image);
    
    if ($result_fetch_image && mysqli_num_rows($result_fetch_image) > 0) {
        $row = mysqli_fetch_assoc($result_fetch_image);
        $image_path = $row['image_path'];
        
        // Delete the image file from the server
        $file_path = 'uploads/' . $image_path;
        if (file_exists($file_path)) {
            unlink($file_path);  // Deletes the file from the server
        }
        
        // Delete the image record from the database
        $sql_delete_image = "DELETE FROM featured_images WHERE id = $image_id";
        mysqli_query($conn, $sql_delete_image);
        
        // Redirect to the same page to avoid form resubmission
        header("Location: FeaturedImages.php");
        exit();
    } else {
        echo "Image not found!";
    }
}

// Fetch all featured images
$sql = "SELECT * FROM featured_images";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Featured Images</title>
    <link rel="icon" href="Logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Container for the featured images */
        .featured-images-section .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Grid layout for images */
        .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        /* Image card */
        .image-card {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Styling for the image */
        .image-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        /* Delete button styling */
        .delete-form {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .btn-delete {
            background-color: rgba(255, 0, 0, 0.8); /* Red background */
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: rgba(255, 0, 0, 1); /* Darker red on hover */
        }

       
    </style>
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
                    <li><a href="About.php">About</a></li>
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


    <main>
        <section class="featured-images-section">
            <div class="container">
                <h2>Manage Featured Images</h2>
                
                <div class="images-grid">
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="image-card">';
                            echo '<img src="uploads/' . htmlspecialchars($row['image_path']) . '" alt="Featured Image">';
                            echo '<form method="POST" action="FeaturedImages.php" class="delete-form">';
                            echo '<input type="hidden" name="image_id" value="' . htmlspecialchars($row['id']) . '">';
                            echo '<button type="submit" name="delete_image" class="btn-delete">Delete</button>';
                            echo '</form>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No featured images found.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>
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
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
</footer>

</body>
</html>
