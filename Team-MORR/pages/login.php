<?php
session_start();
include "/php/errors.php";

if (isset($_POST['submit'])) {
    include "../php/creds.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

//If the username and password are correct
    if ($username == $adminusername && $password == $adminpassword) {
        $_SESSION['username'] = $username;
        if($_SESSION['page-destination'] == "Volunteer Admin"){
            header("location: volunteer-summary-page.php");
        }elseif($_SESSION['page-destination'] == "Dreamer Admin"){
            header("location: dreamers-summary-page.php");
        }else {
            header("location: ../index.php");
        }
    }else {
        echo "The log in info is incorrect, please try again.";
    }
}
include "../php/header.php";
?>
<title>Admin Log In</title>
    <link rel="stylesheet" href="Team-MORR/styles/sign-up-form.css">
</head>
<body>
<div class="jumbotron jumbotron-fluid mb-3 pr-2">
    <img src="//static1.squarespace.com/static/5dabc823c0e45245a9c250cd/t/5dacd1ebfe152f3a7aa1de79/1572281708171/?format=1500w"
         alt="iD.A.Y. Dream" class="img-fluid img-thumbnail rounded float-left">
    <h1 class="display-4 font-weight-bold">Administrative Log In</h1>
</div>
    <h2>Please enter in your credentials below</h2>
    <form method="post" action="#">
        <label>Username:
            <input class="form-control" type="text" name="username">
        </label>
        <br>
        <label>Password:
            <input class="form-control" type="password" name="password">
        </label>
        <br>
        <input type="submit" id="submit" name="submit" value="Submit">
    </form>
</body>
</html>
