<?php
session_start();
include "/php/errors.php";

//if already logged in, redirect to index page
if (isset($_SESSION['username'])) {
    header("location: ../index.php");
}

if (isset($_POST['submit'])) {
    include "../php/creds.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

//If the username and password are correct
    if ($username == $adminusername && $password == $adminpassword) {
        $_SESSION['username'] = $username;
        header("location: ../index.php");
    }
    else {
        echo "The log in info is incorrect, please try again.";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Log In</title>
    <link rel="stylesheet" href="Team-MORR/styles/sign-up-form.css">
</head>
<body>
    <h1>Administrative Log In</h1>
    <h2>Please enter in your credentials below</h2>
    <form method="post" action="#">
        <label>Username:
            <input type="text" name="username">
        </label>
        <br>
        <label>Password:
            <input type="password" name="password">
        </label>
        <br>
        <input type="submit" id="submit" name="submit" value="Submit">
    </form>
</body>
</html>
