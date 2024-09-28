<?php
session_start();
include 'connect.php';

if (isset($_POST['signin'])) {
    $username = $_POST['Usname'] ?? "";
    $email = $_POST['email'] ?? "";
    $password = $_POST['pass'] ?? "";


    $sql = "SELECT * FROM customer WHERE U_name = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['password'];

        // Check the password
        if ($password === $stored_password) {
            $_SESSION['Usname'] = $username;
            $_SESSION['customerID'] = $row['CID'];

            header("Location: CusHome.php");
            exit();
        } else {
     
            header("Location: Signin.php?error=invalid");
            exit();
        }
    } else {
        $sql_admin = "SELECT * FROM admin WHERE U_name = ? AND email = ?";
        $stmt_admin = $conn->prepare($sql_admin);
        $stmt_admin->bind_param("ss", $username, $email);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        // If the user is found in the admin table
        if ($result_admin->num_rows === 1) {
            $row_admin = $result_admin->fetch_assoc();
            $stored_password_admin = $row_admin['password'];

            
            if ($password === $stored_password_admin) {
                $_SESSION['Usname'] = $username;
                $_SESSION['adminID'] = $row_admin['AID']; 

                
                header("Location: AdminDashBoard.php");
                exit();
            } else {
                
                header("Location: Signin.php?error=invalid");
                exit();
            }
        } else {
           
            header("Location: Signin.php?error=invalid");
            exit();
        }

        $stmt_admin->close();
    }

    $stmt->close();
    $conn->close();
}
?>
