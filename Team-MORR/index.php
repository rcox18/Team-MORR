<?php
include "php/errors.php";
include "php/header.php";
?>
<title>Team MORR's HomePage</title>
</head>
<body>
<div class="jumbotron">
    <h1>Welcome to the Team MORR's HomePage.</h1>
    <p>Thanks for visiting our page. Below are link to some of our work samples.</p>
</div>

<div class="container">
    <h2>I Day Dream Web Forms</h2>
    <p><a href="pages/volunteer-form.php">Volunteer Form</a> </p>
    <p><a href="pages/welcome.php">Welcome Form</a></p>
    <form action="pages/volunteer-summary-page.php" method="post" id="link-to-volunteer-summary" name="go-to-volunteers">
        <input class="m-0 mb-3 p-0 btn btn-link" type="submit" id="submit-volunteer-source" name="page-source" value="Volunteer Admin">
    </form>
    <form action="pages/dreamers-summary-page.php" method="post" id="link-to-volunteer-summary" name="go-to-dreamers">
        <input class="m-0 mb-3 p-0 btn btn-link" type="submit" id="submit-dreamer-source" name="page-source" value="Dreamer Admin">
    </form>
</div>
<?php
include "php/footer.php";
?>
</body>
</html>