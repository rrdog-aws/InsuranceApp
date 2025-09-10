<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Store user info in session (you might want to store this in a database instead)
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;

    // Cognito sign-in URL
    $cognito_url = "https://eu-north-183zgsb0xm.auth.eu-north-1.amazoncognito.com/login?client_id=4h8u65ctqp5l0dabrsror66ukt&response_type=code&scope=email+openid+phone&redirect_uri=https%3A%2F%2Fd84l1y8p4kdic.cloudfront.net";

    // Redirect to Cognito sign-in page
    header("Location: " . $cognito_url);
    exit();
} else {
    // If not a POST request, redirect back to the registration form
    header("Location: register.php");
    exit();
}
