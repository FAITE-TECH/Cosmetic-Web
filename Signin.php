<?php
session_start();
include 'connect.php';

if (isset($_POST['signin'])) {
    $username = isset($_POST['Usname']) ? $_POST['Usname'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $password = isset($_POST['pass']) ? $_POST['pass'] : "";

    $sql = "SELECT * FROM customer WHERE U_name='$username' AND email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['Usname'] = $username;
        $_SESSION['customerID'] = $row['CID']; 
        header("location:CusHome.php");
        exit();
    } else {
        echo '<script type="text/javascript"> 
            alert("Invalid Username, Email, or Password. Try again!");
        </script>';
    }
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sign In</title>

    <style>
        body {
            background-color: black;
            height: 100vh;
            background-image: url("Logo/hi.png");
            background-size: cover;
            background-repeat: no-repeat;
        }
        .signin-container {
            background: rgba(153, 153, 153, 0.4);
            color: #f1f1f1;
            border-radius: 15px;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            margin-top: 220px;
        }
        .btn-custom {
            background-color: #84c32f;
            color: white;
            width: 100%;
            border-radius: 15px;
        }
        .btn-custom:hover {
            background-color: #6ba027;
        }
        h3 {
            color: #84c32f;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="signin-container shadow">
            <h3>Owshadham Signin</h3>
            <form id="frm" action="Signin.php" method="post" class="needs-validation" novalidate>
                <!-- Username Field -->
                <div class="mb-3">
                    <label for="Usname" class="form-label"><b>User Name</b></label>
                    <input type="text" class="form-control" id="Usname" name="Usname" placeholder="Enter Your User Name" required>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label"><b>Email</b></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                </div>

                <!-- Password Field -->
                <div class="mb-3">
                    <label for="pass" class="form-label"><b>Password</b></label>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Password" required>
                </div>

                <!-- Privacy Policy Checkbox -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="cb" name="accept" onclick="enableButton()" required>
                    <label class="form-check-label" for="cb">Accept privacy policy and terms</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-custom" id="btn" name="signin" disabled>Sign In</button>
            </form>
        </div>
    </div>

    <!-- JavaScript to enable button on checkbox click -->
    <script>
        function enableButton() {
            var checkBox = document.getElementById("cb");

            if (checkBox.checked == true) {
                document.getElementById("btn").disabled = false;
            } else {
                document.getElementById("btn").disabled = true;
            }
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
