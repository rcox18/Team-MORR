<?php
session_start();
include "php/errors.php";
include "php/header.php";
?>
<title>Team MORR's HomePage</title>
</head>
<body>
<div class="jumbotron">
    <a href="Team-MORR/pages/logout.php" class="btn btn-danger">Sign Out</a>
    <?php
        include "guestbookDBcnx.php";
        //Test connection
        if ($cnxn) {
        echo "<h2>Welcome, " .$_SESSION['username'] ."!</h2>";
        }
        else {
            echo mysqli_connect_error();
        }
        ?>
    <h1>Welcome to the Team Morr's HomePage.</h1>
    <p>Thanks for visiting our page. Below are link to some of our work samples.</p>
</div>

<div class="container">
    <h2>I Day Dream Web Forms</h2>
    <p><a href="http://team-morr.greenriverdev.com/pages/volunteer-form.php">Volunteer Form</a> </p>
    <p><a href="http://team-morr.greenriverdev.com/pages/volunteer-summary-page.php">Volunteer Form Summary</a></p>
    <p><a href="http://team-morr.greenriverdev.com/pages/welcome.php">Welcome Form</a></p>
    <p><a href="http://team-morr.greenriverdev.com/pages/dreamers-summary-page.php">Welcome Form Summary</a></p>
</div>


<?php
include "php/footer.php";
?>
</body>
</html>