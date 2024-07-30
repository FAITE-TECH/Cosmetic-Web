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
    <title>Contact Us - Beauty Skin Care</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #e0f2e9;
        }

        header {
            background: #a7d7c5;
            padding: 10px 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            height: 100px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .header-buttons .btn {
            background-color: #84c32f;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .header-buttons .btn:hover {
            background-color: #6ab83f;
        }

        .contact-banner {
            background: #e0f2e9;
            padding: 50px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .banner-content {
            width: 50%;
        }

        .banner-content h2 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .banner-content p {
            font-size: 16px;
            color: #555;
        }

        .banner-image {
            width: 50%;
            display: flex;
            justify-content: flex-end;
        }

        .banner-image img {
            max-width: 100%;
            height: auto;
        }

        #back {
            background-color: #e0f2e9;
            min-height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.8);
            color: #333;
            width: 90%;
            max-width: 600px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .contact-form {
            display: flex;
            flex-direction: column;
        }

        .contact-form h3 {
            font-family: "Times New Roman", Times, serif;
            color: #84c32f;
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .lbl {
            font-size: 16px;
            margin-bottom: 8px;
        }

        .input-field {
            height: 50px;
            width: 100%;
            margin: 10px 0;
            padding: 0 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        textarea.input-field {
            height: 150px;
            padding-top: 15px;
        }

        #btn {
            background-color: #84c32f;
            color: white;
            padding: 15px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s;
            width: 100%;
        }

        #btn:hover {
            background-color: #6ab83f;
        }

        .contact-details {
            background: #e0f2e9;
            padding: 50px 0;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-item {
            margin-bottom: 20px;
        }

        .contact-item h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 5px;
        }

        .contact-item p {
            font-size: 16px;
            color: #555;
        }

        footer {
            background: #333;
            color: #fff;
            padding: 20px 0;
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .footer-section {
            width: 100%;
            max-width: 24%;
            margin-bottom: 20px;
        }

        .footer-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .footer-section p, .footer-section ul {
            font-size: 14px;
        }

        .footer-section ul {
            padding: 0;
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section a {
            color: #fff;
            text-decoration: none;
        }

        .footer-section a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
            }

            .header-buttons {
                margin-top: 10px;
            }

            .contact-banner {
                flex-direction: column;
            }

            .banner-content,
            .banner-image {
                width: 100%;
            }

            .form-container {
                width: 100%;
                padding: 20px;
            }

            .footer-container {
                flex-direction: column;
                align-items: center;
            }

            .footer-section {
                width: 90%;
                max-width: none;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container header-container">
            <div class="logo">
                <img src="Logo/logo.png" alt="Logo">
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
                    Welcome, <?php echo htmlspecialchars($username); ?>
                    <a href="cart.php" class="btn">Cart</a>
                    <a href="logout.php" class="btn">Log Out</a>
                <?php else: ?>
                    <a href="SignIn.php" class="btn">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div id="back">
        <div class="form-container">
            <form id="contact-form" action="submit_contact.php" method="post" class="contact-form">
                <h3>Contact Us</h3>
                
                <label for="name" class="lbl"><b>Name</b></label>
                <input type="text" id="name" name="name" class="input-field" placeholder="Enter Your Name" required>

                <label for="email" class="lbl"><b>Email</b></label>
                <input type="email" id="email" name="email" class="input-field" placeholder="Enter Your Email" required>

                <label for="subject" class="lbl"><b>Subject</b></label>
                <input type="text" id="subject" name="subject" class="input-field" placeholder="Enter Subject" required>

                <label for="message" class="lbl"><b>Message</b></label>
                <textarea id="message" name="message" class="input-field" placeholder="Enter Your Message" rows="5" required></textarea>

                <input type="submit" id="btn" value="Send Message">
            </form>
        </div>
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
                    <li><a href="index.php">Home</a></li>
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
                <p>Email: <a href="mailto:info@skinvias.com">info@skinvias.com</a></p>
                <p>Phone: <a href="tel:+94765644323">+94 76 564 4323</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
