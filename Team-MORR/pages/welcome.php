<!--
    Filename: volunteer-form.php
    By Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	10/30/2019
	url http://team-morr.greenriverdev.com/pages/welcome.html
	The HTML is used for team Morr's version of a welcome page that could be
    potentially used for Brandi Day's website, non-profit organization iD.A.Y Dream
-->

<?php
require "../php/idaydreamDBconnect.php";
include "../php/errors.php";
include "../php/header.php";
?>

<title>iD.A.Y Welcome Page</title>
</head>

<body>
<div class="container" id="main">
    <div class="jumbotron jumbotron-fluid fixed-top mb-3 pr-2">
        <img src="//static1.squarespace.com/static/5dabc823c0e45245a9c250cd/t/5dacd1ebfe152f3a7aa1de79/1572281708171/?format=1500w"
             alt="iD.A.Y. Dream" class="img-fluid img-thumbnail rounded float-left">
        <h1 class="display-4 font-weight-bold">ID.A.Y.Dream</h1>
        <p class="lead font-weight-bold">Welcome to ID.A.Y.Dream! In order to best serve your needs, we need to
            get to know a little bit about you. Please take a moment to fill out this form. The more you tell us
            about yourself, the better!</p>
    </div>

    <form action="welcome-confirmation-page.php" id="welcome-form" method="post">
        <fieldset class="form-group" id="personal">
            <legend>Personal Info</legend>
            <!--First Name-->
            <label for="first-name">First name<span class="text-danger err" id="fName-err">*required</span></label>
            <input type="text" class="form-control required-input" id="first-name" name="first-name">

            <!--Last Name-->
            <label for="last-name">Last name<span class="text-danger err" id="lName-err">*required</span></label>
            <input type="text" class="form-control required-input" id="last-name" name="last-name">

            <!--Date of Birth-->
            <label for="date-of-birth">Date of Birth<span class="text-danger err" id="dob-err">*required</span></label>
            <input type="date" class="form-control required-input" id="date-of-birth" name="date-of-birth"
                   max="2006-01-01" min="2000-12-31">

            <!--Gender-->
            <div>
                <div class="form-group">
                    <label for="gender">Gender<span class="text-danger err" id="gender-err">*required</span></label>
                    <select class="form-control required-input" id="gender" name="gender">
                        <option class="gender-option" value="none" selected>Gender</option>
                        <option class="gender-option" value="male">Male</option>
                        <option class="gender-option" value="female">Female</option>
                        <option class="gender-option" value="other">Other</option>
                    </select>
                </div>
                <div class="form-inline" id="other-gender">
                    <div class="form-group">
                        <span for="identity">My gender is </span>
                        <input class="form-control" type="text" value="" id="identity" name="identity">
                        <span for="pronouns"> and I use the following pronouns </span>
                        <input  class="form-control" type="text" value="" id="pronouns" name="pronouns">
                    </div>
                </div>
            </div>

            <!--Race/Ethnicity-->
            <label for="race-selector">Race/Ethnicity</label><span class="text-danger err">*required</span>
            <div class="form-group">
                <select class="form-control" id="race-selector" name="race-ethnicity">
                    <option class="race-option" value="none" selected>Select from the following</option>
                    <?php
                    $sql = "SELECT * FROM Ethnicity";
                    $result = mysqli_query($cnxn, $sql);
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $ethnicityID = $row["ethnicityID"];
                        $ethnicity = $row["choice"];

                        echo "<option class='race-option' value='$ethnicityID'>$ethnicity</option>";
                    }
                    ?>
                </select>
                <div id="other-race" >
                    <label for="other-race-text">Please specify</label>
                    <input type="text" class="form-control" id="other-race-text" name="other-race-ethnicity">
                </div>
            </div>

            <!--Favorite food/snacks-->
            <label for="snacks">My favorite snacks and foods are...</label><br>
            <textarea class = "form-control" name="snacks" id="snacks"></textarea>
        </fieldset>

        <fieldset class="form-group" id="contact">
            <legend>Contact Information</legend>
            <!--Email-->
            <label for="email">Email address<span class="text-danger err" id="email-err">*required</span></label>
            <input type="text" class="form-control required-input" name="email-address" id="email">

            <!--Phone Number-->
            <label for="phone">Phone number<span class="text-danger err" id="phone-err">*required</span></label>
            <span class="err" id="err-phone">
                Please enter a phone number
            </span>
            <input type="text" class="form-control required-input" name="phone-number" id="phone">
        </fieldset>

        <fieldset class="form-group" id="contact">
            <legend>Emergency Contact Information</legend>
            <!--Parent/Guardian-->

            <!--First Name-->
            <label for="guardian-first-name">First name<span class="text-danger err" id="gfName-err">*required</span></label>
            <input type="text" class="form-control required-input" id="guardian-first-name" name="guardian-first-name">

            <!--Last Name-->
            <label for="guardian-last-name">Last name<span class="text-danger err" id="glName-err">*required</span></label>
            <input type="text" class="form-control required-input" id="guardian-last-name" name="guardian-last-name">

            <!--Relationship-->
            <label for="guardian-relation">Relationship<span class="text-danger err" id="gRelation-err">*required</span></label>
            <input type="text" class="form-control required-input" id="guardian-relation" name="guardian-relation">

            <!--Email-->
            <label for="g-email">Email address<span class="text-danger err" id="g-email-err">*required</span></label>
            <input type="text" class="form-control required-input" name="g-email-address" id="g-email">

            <!--Phone Number-->
            <label for="g-phone">Phone number<span class="text-danger err" id="g-phone-err">*required</span></label>
            <span class="err" id="g-err-phone">
                Please enter a phone number
            </span>
            <input type="text" class="form-control required-input" name="g-phone-number" id="g-phone">
        </fieldset>

        <fieldset class="form-group" id="future">
            <legend>Future Plans</legend>

            <!--Graduating class-->
            <label for="graduation-year">What is your projected high school graduation year?<span class="text-danger err" id="grad-year-err">*required</span></label>
            <select class="form-control required-input" id="graduation-year" name="graduation-year">
                <option value="none">Class of</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="not-listed">Not listed</option>
            </select>
            <span class="err" id="err-grad-year">
                Please enter in a graduation year
            </span>

            <label for="colleges-of-interest">College(s) of interest</label><br>
            <textarea class="form-control" name="colleges-of-interest" id="colleges-of-interest"></textarea><br>

            <label for="career-aspirations">Career aspirations</label><br>
            <textarea class="form-control" name="career-aspirations" id="career-aspirations"></textarea><br>

            <label for="questions-and-concerns">Any questions or concerns about the program</label><br>
            <textarea class="form-control" name="questions-and-concerns" id="questions-and-concerns"></textarea>
        </fieldset>

        <button id="submit" class="btn btn-success">Submit</button>

    </form>
</div>

<?php
include "../php/footer.php";
?>
<script src="../scripts/welcome-form.js"></script>
</body>
</html>
