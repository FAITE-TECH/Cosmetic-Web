<?php
include 'connect.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $sql = "SELECT * FROM customer WHERE U_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "exists";
    } else {
        echo "unique";
    }

    $stmt->close();
    $conn->close();
    exit();
}

if (isset($_POST['sign'])) {
    $unam = $_POST['Uname'] ?? "";
    $number = $_POST['Mnumber'] ?? "0";
    $mail = $_POST['myEmail'] ?? "";
    $passw = $_POST['pwrd'] ?? "";

    //$hashed_password = password_hash($passw, PASSWORD_DEFAULT);

    $sql = "INSERT INTO customer (U_name, mnumber, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $unam, $number, $mail, $passw);

    if ($stmt->execute()) {
        header("Location: Signin.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
