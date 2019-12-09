<!--
    Filename: volunteer-confirmation-page.php
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	10/30/2019
	url: http://team-morr.greenriverdev.com/pages/volunteer-confirmation-page.php
	The confirmation page when volunteer-form.html is submitted successfully. Sends siteEmail containing the submitted data.
-->

<?php
//Search and execute php files for error debugger, connection to database and header
include "../php/errors.php";
include "../php/header.php";
?>

<title>Volunteer Application Success</title>
</head>
<body>
<?php
//Regex values to validate certain conventions and patterns for inputs in regards to name, text, email, and phone
$nameRegex = "/^([a-zA-Z' -]+)$/";
$basicTextRegex = "/^([a-zA-Z0-9'\", .()\r\n&!?-]+)$/";
$emailRegex = "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i";
$phoneRegex = "/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/";
$zipRegex = "/^\d{5}$/";

if (!empty($_POST)){

    require "../php/idaydreamDBconnect.php";

    /*----CHECKING CONNECTION FIRST----*/
    if ($cnxn){

        $isValid = true;
        /*----Begin Validation----*/
        //Validate first name
        if (!empty($_POST['first-name']) AND preg_match($nameRegex, trim($_POST['first-name']))){
            $fName = ucfirst(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["first-name"]))));
        }else{
            echo '<p>Please enter a valid first name.</p>';
            $isValid = false;
        }

        //Validate last name
        if (!empty($_POST['last-name']) AND preg_match($nameRegex, trim($_POST['last-name']))){
            $lName = ucfirst(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["last-name"]))));
        }else{
            echo '<p>Please enter a valid last name.</p>';
            $isValid = false;
        }

        //Validate email test
        if (empty($_POST["email"])){
            echo '<p>Please provide an email.</p>';
            $isValid= false;
        }elseif (!empty($_POST["email"]) AND !preg_match($emailRegex, trim($_POST['email']))){
            echo '<p>Please provide a valid email.</p>';
            $isValid= false;
        }
        else{
            $email = mysqli_real_escape_string($cnxn, trim($_POST['email']));
        }

        //Add to mailing list?
        if($_POST['add-to-email'] != 'yes' AND $_POST['add-to-email'] != 'no'){
            echo '<p>Invalid input detected in the add to mailing list selector.</p>';
            $isValid= false;
        }else{
            $addToEmail = ucfirst(mysqli_real_escape_string($cnxn, $_POST['add-to-email']));
        }

        //Validate phone
        if (empty($_POST["phone"])){
            echo '<p>Please provide a phone number.</p>';
            $isValid= false;
        }elseif (!empty($_POST["phone"]) AND !preg_match($phoneRegex, trim($_POST['phone']))){
            echo '<p>Please provide a valid phone number.</p>';
            $isValid= false;
        }
        else{
            $phone = mysqli_real_escape_string($cnxn, trim($_POST['phone']));
        }

        // validate address NOT COMPLETE!!!!!!!!!!
        if (empty($_POST["address-street"])){
            echo '<p>Please provide a street address.</p>';
            $isValid= false;
        }elseif (!preg_match($basicTextRegex, trim($_POST['address-street']))){
            echo '<p>Please provide a valid address.</p>';
            $isValid= false;
        }else{
            $address = mysqli_real_escape_string($cnxn, strip_tags(trim($_POST['address-street'])));
        }

        //validate Apt/PO Box #
        if (!empty($_POST["apo-po-box"])){
            if (!preg_match($basicTextRegex, trim($_POST['apo-po-box']))){
                echo '<p>Please provide a valid Apt/PO Box.</p>';
                $isValid= false;
            }else{
                $aptPO = mysqli_real_escape_string($cnxn, strip_tags(trim($_POST['apo-po-box'])));
            }
        }else{
            $aptPO = "";
        }

        //validate city
        if (empty($_POST["city"])){
            echo "<p>Please provide a city.</p>";
            $isValid = false;
        }elseif (!preg_match($basicTextRegex, trim($_POST['city']))){
            echo '<p>Please provide a valid city.</p>';
            $isValid= false;
        }else{
            $city = mysqli_real_escape_string($cnxn, strip_tags(trim($_POST['city'])));
        }

        //validate state
        if (isset($_POST["state"])){
            if ($_POST["state"] != "AL" AND $_POST["state"] != "AK" AND $_POST["state"] != "AR" AND
                $_POST["state"] != "AZ" AND $_POST["state"] != "CA" AND $_POST["state"] != "CO" AND
                $_POST["state"] != "CT" AND $_POST["state"] != "DC" AND $_POST["state"] != "DE" AND
                $_POST["state"] != "FL" AND $_POST["state"] != "GA" AND $_POST["state"] != "HI" AND
                $_POST["state"] != "IA" AND $_POST["state"] != "ID" AND $_POST["state"] != "IL" AND
                $_POST["state"] != "IN" AND $_POST["state"] != "KS" AND $_POST["state"] != "KY" AND
                $_POST["state"] != "LA" AND $_POST["state"] != "MA" AND $_POST["state"] != "MD" AND
                $_POST["state"] != "ME" AND $_POST["state"] != "MI" AND $_POST["state"] != "MN" AND
                $_POST["state"] != "MO" AND $_POST["state"] != "MS" AND $_POST["state"] != "MT" AND
                $_POST["state"] != "NC" AND $_POST["state"] != "NE" AND $_POST["state"] != "NH" AND
                $_POST["state"] != "NJ" AND $_POST["state"] != "NM" AND $_POST["state"] != "NV" AND
                $_POST["state"] != "NY" AND $_POST["state"] != "ND" AND $_POST["state"] != "OH" AND
                $_POST["state"] != "OK" AND $_POST["state"] != "OR" AND $_POST["state"] != "PA" AND
                $_POST["state"] != "RI" AND $_POST["state"] != "SC" AND $_POST["state"] != "SD" AND
                $_POST["state"] != "TN" AND $_POST["state"] != "TX" AND $_POST["state"] != "UT" AND
                $_POST["state"] != "VT" AND $_POST["state"] != "VA" AND $_POST["state"] != "WA" AND
                $_POST["state"] != "WI" AND $_POST["state"] != "WV" AND $_POST["state"] != "WY"){
                echo '<p>Please provide a valid state.</p>';
                $isValid= false;
            }else{
                $state = mysqli_real_escape_string($cnxn, $_POST["state"]);
            }
        }else{
            echo '<p>Please provide a valid state.</p>';
            $isValid= false;
        }

        //validate zip
        if(empty($_POST["zip"])){
            echo '<p>Please provide a zip code.</p>';
            $isValid= false;
        }elseif (!preg_match($zipRegex, trim($_POST["zip"]))){
            echo '<p>Please provide a valid zip code.</p>';
            $isValid= false;
        }else{
            $zip = mysqli_real_escape_string($cnxn, trim($_POST["zip"]));
        }

        //validate interests
        if (isset($_POST["interests"])){
            $interests = "";
            foreach ($_POST["interests"] AS $k => $v){
                if($v != "Events" AND $v != "Fundraising" AND $v != "Newsletter production" AND
                   $v != "Volunteer coordination" AND $v != "Mentoring" AND $v != "other"){
                    echo '<p>Please make valid interest selections.</p>';
                    $isValid= false;
                }elseif ($v == "other"){
                    if (empty($_POST["other-interests-text"])){
                        echo '<p>Please tell us about your other interests.</p>';
                        $isValid= false;
                    }elseif (!preg_match($basicTextRegex, trim($_POST["other-interests-text"]))){
                        echo '<p>Please provide valid input for your other interests.</p>';
                        $isValid= false;
                    }else{
                        $interests.=mysqli_real_escape_string($cnxn, trim($_POST["other-interests-text"]));
                    }
                }else{
                    if ($k != sizeof($_POST["interests"])-1){
                        $interests.=($v.", ");
                    }else{
                        $interests.=$v;
                    }
                }
            }
        }else{
            $interests = "";
        }

        //validate how heard about us section
        if(isset($_POST["hear-about-us"])){
            if ($_POST["hear-about-us"] != "word" AND $_POST["hear-about-us"] != "media" AND
                $_POST["hear-about-us"] != "print" AND $_POST["hear-about-us"] != "sponsor" AND
                $_POST["hear-about-us"] != "other" AND $_POST["hear-about-us"] != "none"){

                echo '<p>Please provide valid input for how you heard about us.</p>';
                $isValid= false;
            }elseif ($_POST["hear-about-us"] == "none"){
                $hearAboutUs = "";
            }elseif ($_POST["hear-about-us"] == "other"){
                if (empty($_POST["other-about-us"])){
                    echo '<p>Please specify how you heard about us.</p>';
                    $isValid= false;
                }elseif (!preg_match($basicTextRegex, $_POST["other-about-us"])){
                    echo '<p>Please provide valid input for how you heard about us.</p>';
                    $isValid= false;
                }else{
                    $hearAboutUs = mysqli_real_escape_string($cnxn, ucfirst(trim($_POST["other-about-us"])));
                }
            }else{
                $hearAboutUs = ucfirst($_POST["hear-about-us"]);
            }
        }else{
            $hearAboutUs = "";
        }

        //t-shirt size
        if ($_POST["tshirt-size"] != "none" AND $_POST["tshirt-size"] != "xsmall" AND $_POST["tshirt-size"] != "small" AND
            $_POST["tshirt-size"] != "medium" AND $_POST["tshirt-size"] != "large" AND $_POST["tshirt-size"] != "xlarge" AND
            $_POST["tshirt-size"] != "1x" AND $_POST["tshirt-size"] != "2x"){

            echo '<p>Please provide valid input for t-shirt size.</p>';
            $isValid= false;
        }elseif ($_POST["tshirt-size"] == "none"){
            echo '<p>Please select a t-shirt size.</p>';
            $isValid= false;
        }else{
            $shirtSize = $_POST["tshirt-size"];
        }

        //validate interested roles
        if (!empty($_POST["roles"])){
            if (!preg_match($basicTextRegex, $_POST["roles"])){
                echo '<p>Please provide valid input for roles of interest.</p>';
                $isValid= false;
            }else{
                $roles = mysqli_real_escape_string($cnxn, ucfirst(trim($_POST["roles"])));
            }
        }else{
            $roles = "";
        }

        //validate previous volunteer experience
        if (!empty($_POST["prev-experience"])){
            if (!preg_match($basicTextRegex, $_POST["prev-experience"])){
                echo '<p>Please provide valid input for previous volunteer experience.</p>';
                $isValid= false;
            }else{
                $prevExp = mysqli_real_escape_string($cnxn, ucfirst(trim($_POST["prev-experience"])));
            }
        }else{
            $prevExp = "";
        }

        //validate other applicable experience
        if (!empty($_POST["applicable-exp"])){
            if (!preg_match($basicTextRegex, $_POST["applicable-exp"])){
                echo '<p>Please provide valid input for roles of interest.</p>';
                $isValid= false;
            }else{
                $applicableExp = mysqli_real_escape_string($cnxn, ucfirst(trim($_POST["applicable-exp"])));
            }
        }else{
            $applicableExp = "";
        }

        //validate motivation to join *required
        if (empty($_POST["motivation"])){
            echo '<p>Please tell us what motivates you to join iD.A.Y. Dream.</p>';
            $isValid= false;
        }elseif (!preg_match($basicTextRegex, $_POST["motivation"])){
            echo '<p>Please provide valid input for what motivates you to join iD.A.Y. Dream.</p>';
            $isValid= false;
        }else{
            $motivation = mysqli_real_escape_string($cnxn, ucfirst(trim($_POST["motivation"])));
        }

        //validate availability
        if (isset($_POST["availability"])){
            $availability = "";
            foreach ($_POST["availability"] AS $k => $v){
                if($v != "weekdays" AND $v != "monday" AND $v != "mon-morn" AND
                    $v != "mon-aft" AND $v != "mon-eve" AND $v != "tuesday" AND
                    $v != "tues-morn" AND $v != "tues-aft" AND $v != "tues-eve" AND
                    $v != "wednesday" AND $v != "wed-morn" AND $v != "wed-aft" AND
                    $v != "wed-eve" AND $v != "thursday" AND $v != "thurs-morn" AND
                    $v != "thurs-aft" AND $v != "thurs-eve" AND $v != "friday" AND
                    $v != "fri-morn" AND $v != "fri-aft" AND $v != "fri-eve" AND
                    $v != "weekends" AND $v != "saturday" AND $v != "sat-morn" AND
                    $v != "sat-aft" AND $v != "sat-eve" AND $v != "sunday" AND
                    $v != "sun-morn" AND $v != "sun-aft" AND $v != "sun-eve" AND
                    $v != "summer-camp"){
                    echo '<p>Please make valid availability selections.</p>';
                    $isValid= false;
                }elseif ($v == "summer-camp"){
                    $availability.=ucfirst($v);
                    if (!empty($_POST["summer-conflicts"])) {
                        if (!preg_match($basicTextRegex, trim($_POST["summer-conflicts"]))) {
                            echo '<p>Please provide valid input for your summer camp conflicts.</p>';
                            $isValid = false;
                        }else{
                            $availability .= (", ".mysqli_real_escape_string($cnxn, ucfirst(trim($_POST["summer-conflicts"]))));
                        }
                    }
                }else{
                    if ($k != sizeof($_POST["availability"])-1){
                        $availability.=(ucfirst($v).", ");
                    }else{
                        $availability.=ucfirst($v);
                    }
                }
            }
        }else{
            $availability = "";
        }

        //validate references *all 3 required
        //Reference 1:
        //name
        if (empty($_POST["ref1-name"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($nameRegex, $_POST["ref1-name"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref1Name = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref1-name"])));
        }
        //relationship
        if (empty($_POST["ref1-relation"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($basicTextRegex, $_POST["ref1-relation"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref1Relation = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref1-relation"])));
        }
        //phone
        if (empty($_POST["ref1-phone"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($phoneRegex, $_POST["ref1-phone"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref1Phone = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref1-phone"])));
        }
        //email
        if (empty($_POST["ref1-email"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($emailRegex, $_POST["ref1-email"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref1Email = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref1-email"])));
        }

        //Reference 2:
        //name
        if (empty($_POST["ref2-name"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($nameRegex, $_POST["ref2-name"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref2Name = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref2-name"])));
        }
        //relationship
        if (empty($_POST["ref2-relation"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($basicTextRegex, $_POST["ref2-relation"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref2Relation = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref2-relation"])));
        }
        //phone
        if (empty($_POST["ref2-phone"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($phoneRegex, $_POST["ref2-phone"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref2Phone = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref2-phone"])));
        }
        //email
        if (empty($_POST["ref2-email"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($emailRegex, $_POST["ref2-email"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref2Email = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref2-email"])));
        }

        //Reference 3:
        //name
        if (empty($_POST["ref3-name"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($nameRegex, $_POST["ref3-name"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref3Name = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref3-name"])));
        }
        //relationship
        if (empty($_POST["ref3-relation"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($basicTextRegex, $_POST["ref3-relation"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref3Relation = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref3-relation"])));
        }
        //phone
        if (empty($_POST["ref3-phone"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($phoneRegex, $_POST["ref3-phone"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref3Phone = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref3-phone"])));
        }
        //email
        if (empty($_POST["ref3-email"])){
            echo '<p>All reference fields are required.</p>';
            $isValid = false;
        }elseif (!preg_match($emailRegex, $_POST["ref3-email"])){
            echo '<p>Please provide valid input for references.</p>';
            $isValid = false;
        }else{
            $ref3Email = mysqli_real_escape_string($cnxn, ucwords(trim($_POST["ref3-email"])));
        }
        /*-----End Validation-----*/
    }else{
        echo "<h3>Connection Failed!</h3>";
        echo "<p>Please go back and resubmit.</p>";
    }

    //All input is valid and ready for database insertion
    if ($isValid){
        $siteEmail = "rcox18@mail.greenriver.edu";
        $email_body = "Applicant Information --\r\n";
        $email_body .= "Name: $fName $lName\r\n";
        $email_subject = "New Volunteer application";
        $to = $siteEmail;
        $headers = "From: $siteEmail\r\n";
        $headers .= "Reply-To: $siteEmail \r\n";

        /*------SQL Insertion-------*/
        //first insert references to generate ID's
        //ref 1 insertion
        $ref1InsertSQL = "INSERT INTO Ref (name, relationship, phone, email) VALUES ('$ref1Name', '$ref1Relation', '$ref1Phone', '$ref1Email')";
        $ref1Result = mysqli_query($cnxn, $ref1InsertSQL);
        //get generated key
        $ref1ID = mysqli_insert_id($cnxn);

        //ref 2 insertion
        $ref2InsertSQL = "INSERT INTO Ref (name, relationship, phone, email) VALUES ('$ref2Name', '$ref2Relation', '$ref2Phone', '$ref2Email')";
        $ref2Result = mysqli_query($cnxn, $ref2InsertSQL);
        //get generated key
        $ref2ID = mysqli_insert_id($cnxn);

        //ref 3 insertion
        $ref3InsertSQL = "INSERT INTO Ref (name, relationship, phone, email) VALUES ('$ref3Name', '$ref3Relation', '$ref3Phone', '$ref3Email')";
        $ref3Result = mysqli_query($cnxn, $ref3InsertSQL);
        //get generated key
        $ref3ID = mysqli_insert_id($cnxn);

        //insertions good
        if ($ref1Result AND $ref2Result And $ref3Result){

            $active = "pending";

            //insertion for volunteer
            $volunteerInsertSQL = "INSERT INTO Volunteer (name, email, phone, address, shirtSize, mailingList, motivation, POBox, city, state, zip, interests, hearAboutUs, rolesOfInterests, previousExp, expMention, availability, active, submissionDate, ref1, ref2, ref3) Values  ('$fName $lName', '$email', '$phone', '$address', '$shirtSize', '$addToEmail', '$motivation', '$aptPO', '$city', '$state', '$zip', '$interests', '$hearAboutUs', '$roles', '$prevExp', '$applicableExp', '$availability', '$active', NOW(), '$ref1ID', '$ref2ID', '$ref3ID')";
            $volunteerResult = mysqli_query($cnxn, $volunteerInsertSQL);

            if($volunteerResult) {
                /*--------------Load actual page starting with jumbotron-----------*/
                echo "<div class=\"jumbotron jumbotron-fluid fixed-top mb-3 pr-2\">
                      <img src=\"//static1.squarespace.com/static/5dabc823c0e45245a9c250cd/t/5dacd1ebfe152f3a7aa1de79/1572281708171/?format=1500w\"
                           alt=\"iD.A.Y. Dream\" class=\"img-fluid img-thumbnail rounded float-left\">
                      <h1 class=\"display-4 font-weight-bold\">ID.A.Y.Dream</h1>
                      <p class=\"lead font-weight-bold\">$fName, thank you for your interest in supporting our youth.
                      Your information has been sent to iD.A.Y. dream. If you see any errors in the following submitted info, please contact us 
                      <a href=\"https://www.idaydream.org/contact-us\">here</a> ASAP for corrections.</p>
                  </div>";
                /*----DISPLAY SUBMITTED INFO BACK TO APPLICANT----*/

                echo "<div class='container'>";
                echo "<span><strong>Name: </strong>$fName $lName</span><br>";
                echo "<span><strong>Email: </strong>$email</span><br>";
                echo "<span><strong>Add to mailing list: </strong>$addToEmail</span><br>";
                echo "<span><strong>Phone: </strong>$phone</span><br>";
                echo "<span><strong>Address: </strong>$address</span><br>";
                if ($aptPO != ""){
                    echo "<span><strong>Apt./PO Box: </strong>$aptPO</span><br>";
                }
                echo "<span><strong>City: </strong>$city</span><br>";
                echo "<span><strong>State: </strong>$state</span><br>";
                echo "<span><strong>Zip: </strong>$zip</span><br>";
                if ($interests != ""){
                    echo "<span><strong>Interests: </strong>$interests</span><br>";
                }
                if ($hearAboutUs != ""){
                    echo "<span><strong>How you heard about us: </strong>$hearAboutUs</span><br>";
                }
                echo "<span><strong>T-shirt size: </strong>$shirtSize</span><br>";
                if ($roles != ""){
                    echo "<span><strong>Interested roles: </strong>$roles</span><br>";
                }
                if ($prevExp != ""){
                    echo "<span><strong>Previous volunteer experience: </strong>$prevExp</span><br>";
                }
                if ($applicableExp != ""){
                    echo "<span><strong>Other applicable experience: </strong>$applicableExp</span><br>";
                }
                echo "<span><strong>Motivation to join iD.A.Y. Dream: </strong>$motivation</span><br>";
                if ($availability != ""){
                    echo "<span><strong>Availability: </strong>$availability</span><br>";
                }
                echo "<span><strong>Reference 1: </strong></span><br>";
                echo "<span><strong>Name: </strong>$ref1Name <strong>Relationship: </strong>$ref1Relation ";
                echo "<strong>Phone: </strong>$ref1Phone <strong>Email: </strong>$ref1Email</span><br>";
                echo "<span><strong>Reference 2: </strong></span><br>";
                echo "<span><strong>Name: </strong>$ref2Name <strong>Relationship: </strong>$ref2Relation ";
                echo "<strong>Phone: </strong>$ref2Phone <strong>Email: </strong>$ref2Email</span><br>";
                echo "<span><strong>Reference 2: </strong></span><br>";
                echo "<span><strong>Name: </strong>$ref3Name <strong>Relationship: </strong>$ref3Relation ";
                echo "<strong>Phone: </strong>$ref3Phone <strong>Email: </strong>$ref3Email</span><br>";
                echo "</div>";
                /*-------------End Message--------------------*/

                //adds the raw data to the display
                $info = "<p>";
                foreach ($_POST as $key => $value){
                    if(is_array($value)){
                        foreach ($value as $k => $v){
                            $info.= $key.': '.$v."<br>";
                            $email_body.= $key.': '.$v."\r\n";
                        }
                    }else{
                        $info.= $key.': '.$value."<br>";
                        $email_body.= $key.': '.$value."\r\n";
                    }
                }

                $info .= "</p>";
                //echo $info;
                //sends siteEmail
                $success = mail($to, $email_subject, $email_body, $headers);
            }else{
                echo mysqli_error($cnxn);
                echo "<p>Something went wrong. Please try again!</p>";
            }
        }else{
            echo mysqli_error($cnxn);
            echo "<p>Something went wrong. Please try again!</p>";
        }
    }else{
        echo "<p>Try again.</p>";
    }
}else{
    echo "<p>Please fill out our form.</p>";
}

function flipCoin()
{
    $randNum = rand(0, 1);
    if ($randNum == 0){
        return "yes";
    }else{
        return "no";
    }
}

include "../php/footer.php";
?>
</body>
</html>