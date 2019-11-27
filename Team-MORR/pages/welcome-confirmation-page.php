<!--
    Filename: welcome-confirmation-page.php
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	10/30/2019
	url: http://team-morr.greenriverdev.com/pages/welcome-confirmation-page.php
	The confirmation page when volunteer-form.html is submitted successfully. Sends email containing the submitted data.
-->

<?php
//Search and execute php files for error debugger and header
include "../php/errors.php";
include "../php/header.php";
?>
<title>Welcome Page Confirmation</title>
</head>
<body>
<?php
//Regex values to validate certain conventions and patterns for inputs in regards to name, text, email, and phone
$nameRegex = "/^([a-zA-Z' -]+)$/";
$basicTextRegex = "/^([a-zA-Z0-9'\", .()\r\n&!?-]+)$/";
$emailRegex = "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/i";
$phoneRegex = "/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/";

//Form has been submitted with info
if (!empty($_POST)){

    require "../php/idaydreamDBconnect.php";

    /*----CHECKING CONNECTION FIRST----*/
    if ($cnxn){

        $isValid= true;

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

        //Validate D.O.B.
        if (!empty($_POST['date-of-birth'])){
            $dob = $_POST["date-of-birth"];
        }else{
            echo '<p>Please enter a date.</p>';
            $isValid = false;
        }

        //Validate gender
        if ($_POST["gender"] == 'none'){
            echo '<p>Please select a gender.</p>';
            $isValid= false;
        }elseif ($_POST["gender"] == 'other'){
            if (!empty($_POST["identity"]) AND !empty($_POST["pronouns"])){
                if(preg_match($basicTextRegex, trim($_POST["identity"])) AND
                    preg_match($basicTextRegex, trim($_POST["pronouns"]))){
                    $gender = ucwords(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["identity"]))));
                    $pronouns = ucwords(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["pronouns"]))));
                }else{
                    echo '<p>Please provide valid gender inputs.</p>';
                    $isValid = false;
                }
            }else{
                echo '<p>Please inform us about your identity.</p>';
                $isValid = false;
            }
        }elseif ($_POST["gender"] != 'male' AND $_POST["gender"] != 'female'){
            echo '<p>Please provide valid gender inputs.</p>';
            $isValid = false;
        }else{
            $gender = ucfirst($_POST["gender"]);
            $pronouns = "";
        }

        //Validate race/ethnicity
        if ($_POST["race-ethnicity"] == 'none'){
            echo '<p>Please inform us about you race/ethnicity.</p>';
            $isValid= false;
        }elseif ($_POST["race-ethnicity"] == "7"){
            if (!empty($_POST["other-race-ethnicity"])){
                if (preg_match($basicTextRegex, trim($_POST["other-race-ethnicity"]))){
                    $raceEthnicity = ucfirst($_POST["race-ethnicity"]);
                    $otherRace = ucwords(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["other-race-ethnicity"]))));
                }else{
                    echo '<p>Please provide valid race/ethnicity inputs.</p>';
                    $isValid = false;
                }
            }else{
                echo '<p>Please inform us about your race/ethnicity.</p>';
                $isValid= false;
            }
        }elseif ($_POST["race-ethnicity"] != "1" AND $_POST["race-ethnicity"] != "2" AND
                 $_POST["race-ethnicity"] != "3" AND $_POST["race-ethnicity"] != "4" AND
                 $_POST["race-ethnicity"] != "5" AND $_POST["race-ethnicity"] != "6" ){
            echo '<p>Please provide valid race/ethnicity inputs.</p>';
            $isValid = false;
        }else{
            $raceEthnicity = ucfirst($_POST["race-ethnicity"]);
            $otherRace = "";
        }

        //Validate snacks
        if (!empty($_POST['snacks']) AND preg_match($basicTextRegex, trim($_POST['snacks']))) {
            $snacks = ucfirst(mysqli_real_escape_string($cnxn, trim($_POST["snacks"])));
        }
        elseif (!empty($_POST['snacks']) AND !preg_match($basicTextRegex, trim($_POST['snacks']))){
            echo '<p>Please provide valid input for snacks.</p>';
            $isValid= false;
        }else{
            $snacks = "";
        }

        //Validate email test
        if (empty($_POST["email-address"])){
            echo '<p>Please provide an email.</p>';
            $isValid= false;
        }elseif (!empty($_POST["email-address"]) AND !preg_match($emailRegex, trim($_POST['email-address']))){
            echo '<p>Please provide a valid email.</p>';
            $isValid= false;
        }
        else{
            $email = mysqli_real_escape_string($cnxn, trim($_POST['email-address']));
        }

        //Validate phone
        if (empty($_POST["phone-number"])){
            echo '<p>Please provide a phone number.</p>';
            $isValid= false;
        }elseif (!empty($_POST["phone-number"]) AND !preg_match($phoneRegex, trim($_POST['phone-number']))){
            echo '<p>Please provide a valid phone number.</p>';
            $isValid= false;
        }
        else{
            $phone = mysqli_real_escape_string($cnxn, trim($_POST['phone-number']));
        }

        //Check graduation year
        if ($_POST["graduation-year"] == "none"){
            echo '<p>Please select a graduation year.</p>';
            $isValid= false;
        }elseif ($_POST["graduation-year"] == "not-listed"){
            echo '<p>You can join us when you\'re closer to graduating.</p>';
            $isValid= false;
        }else{
            $gradYear = $_POST["graduation-year"];
        }

        //Validate colleges of interest
        if (!empty($_POST['colleges-of-interest']) AND preg_match($basicTextRegex, trim($_POST['colleges-of-interest']))) {
            $collegeInterests = ucfirst(mysqli_real_escape_string($cnxn, trim($_POST["colleges-of-interest"])));
        }
        elseif (!empty($_POST['colleges-of-interest']) AND !preg_match($basicTextRegex, trim($_POST['colleges-of-interest']))){
            echo '<p>Please provide valid input for colleges of interest.</p>';
            $isValid= false;
        }else{
            $collegeInterests = "";
        }

        //Validate career aspirations
        if (!empty($_POST['career-aspirations']) AND preg_match($basicTextRegex, trim($_POST['career-aspirations']))) {
            $careerAspirations = ucfirst(mysqli_real_escape_string($cnxn, trim($_POST["career-aspirations"])));
        }
        elseif (!empty($_POST['career-aspirations']) AND !preg_match($basicTextRegex, trim($_POST['career-aspirations']))){
            echo '<p>Please provide valid input for career aspirations.</p>';
            $isValid= false;
        }else{
            $careerAspirations = "";
        }

        //Validate questions or concerns
        if (!empty($_POST['questions-and-concerns']) AND preg_match($basicTextRegex, trim($_POST['questions-and-concerns']))) {
            $qAndConcerns = ucfirst(mysqli_real_escape_string($cnxn, trim($_POST["questions-and-concerns"])));
        }
        elseif (!empty($_POST['questions-and-concerns']) AND !preg_match($basicTextRegex, trim($_POST['questions-and-concerns']))){
            echo '<p>Please provide valid input for career aspirations.</p>';
            $isValid= false;
        }else{
            $qAndConcerns = "";
        }

        //Validate Emergency Contact Information

        //Validate guardian first name
        if (!empty($_POST['guardian-first-name']) AND preg_match($nameRegex, trim($_POST['guardian-first-name']))){
            $gFName = ucfirst(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["guardian-first-name"]))));
        }else{
            echo '<p>Please enter a valid guardian first name.</p>';
            $isValid = false;
        }

        //Validate guardian last name
        if (!empty($_POST['guardian-last-name']) AND preg_match($nameRegex, trim($_POST['guardian-last-name']))){
            $gLName = ucfirst(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["guardian-last-name"]))));
        }else{
            echo '<p>Please enter a valid guardian last name.</p>';
            $isValid = false;
        }

        //Validate guardian relationship
        if (!empty($_POST['guardian-relation']) AND preg_match($basicTextRegex, trim($_POST['guardian-relation']))){
            $gRelation = ucfirst(strtolower(mysqli_real_escape_string($cnxn, trim($_POST["guardian-relation"]))));
        }else{
            echo '<p>Please enter a valid guardian relationship.</p>';
            $isValid = false;
        }

        //Validate guardian phone
        if (empty($_POST["g-phone-number"])){
            echo '<p>Please provide phone number for parent/guardian.</p>';
            $isValid= false;
        }elseif (!empty($_POST["g-phone-number"]) AND !preg_match($phoneRegex, trim($_POST['g-phone-number']))){
            echo '<p>Please provide a valid phone number for parent/guardian.</p>';
            $isValid= false;
        }
        else{
            $gPhone = mysqli_real_escape_string($cnxn, trim($_POST['g-phone-number']));
        }

        //Validate guardian email
        if (empty($_POST["g-email-address"])){
            echo '<p>Please provide an guardian email.</p>';
            $isValid= false;
        }elseif (!empty($_POST["g-email-address"]) AND !preg_match($emailRegex, trim($_POST['g-email-address']))){
            echo '<p>Please provide a valid guardian email.</p>';
            $isValid= false;
        }
        else{
            $gEmail = mysqli_real_escape_string($cnxn, trim($_POST['g-email-address']));
        }
    }
    else{
        echo "<h3>Connection Failed!</h3>";
        echo "<p>Please go back and resubmit.</p>";
    }

    //All input is valid and ready for database insertion
    if ($isValid){
        $siteEmail = "rcox18@mail.greenriver.edu";
        $email_body = "Applicant Information --\r\n";
        $email_body .= "Name: $fName $lName\r\n";
        $email_subject = "Welcome to ID.A.Y.Dream!";
        $to = $siteEmail;
        $headers = "From: $siteEmail\r\n";
        $headers .= "Reply-To: $siteEmail \r\n";

        /*----ADD TO DATABASE----*/
        $sql = "INSERT INTO Dreamer (name, dob, gradDate, gender, pronouns, otherRace, phone, email, snacks, collegeInterest, careerAspirations, concerns, ethnicityID, parentName, parentRelationship, parentEmail, parentPhone) VALUES ('$fName $lName', '$dob', '$gradYear', '$gender', '$pronouns', '$otherRace', '$phone', '$email', '$snacks', '$collegeInterests', '$careerAspirations', '$qAndConcerns', '$raceEthnicity', '$gFName $gLName', '$gRelation', '$gEmail', '$gPhone');";
        $result = mysqli_query($cnxn, $sql);

        if($result) {
            /*----DISPLAY SUBMITTED INFO BACK TO APPLICANT----*/

            $sql2 = "SELECT * FROM Dreamer WHERE name = '$fName $lName' AND dob = '$dob';";
            $sql3 = "SELECT choice FROM Ethnicity WHERE ethnicityID = '$raceEthnicity';";

            $result2 = mysqli_query($cnxn, $sql2);
            $result3 = mysqli_query($cnxn, $sql3);

            $row = mysqli_fetch_assoc($result2);
            $row2 = mysqli_fetch_assoc($result3);

            echo "<div class=\"jumbotron jumbotron-fluid fixed-top mb-3 pr-2\">
                  <img src=\"//static1.squarespace.com/static/5dabc823c0e45245a9c250cd/t/5dacd1ebfe152f3a7aa1de79/1572281708171/?format=1500w\"
                       alt=\"iD.A.Y. Dream\" class=\"img-fluid img-thumbnail rounded float-left\">
                  <h1 class=\"display-4 font-weight-bold\">ID.A.Y.Dream</h1>
                  <p class=\"lead font-weight-bold\">Your Information Has Been Submitted!</p>
                  </div>
                  <p>$fName, thank you for telling us a little bit about yourself! This information
                  is vital to our goals of best serving our Dreamers. If you see any errors in
                  the following submitted info, please contact us ASAP for corrections.</p>";

            echo "<span><strong>Name:</strong> ".$row["name"]."</span><br>";
            echo "<span><strong>Date of Birth: </strong>".$row["dob"]."</span><br>";
            echo "<span><strong>Identifies as: </strong>".$row["gender"]."</span><br>";
            if($pronouns != ""){
                echo "<span><strong>Preferred Pronouns: </strong>".$row["pronouns"]."</span><br>";
            }
            if ($raceEthnicity != "7"){
                echo "<span><strong>Race/Ethnicity: </strong>".$row2["choice"]."</span><br>";
            }else{
                echo "<span><strong>Race/Ethnicity: </strong>".$row["otherRace"]."</span><br>";
            }

            echo "<span><strong>Preferred Snacks: </strong>".$row["snacks"]."</span><br>";
            echo "<span><strong>Email: </strong>".$row["email"]."</span><br>";
            echo "<span><strong>Phone: </strong>".$row["phone"]."</span><br>";
            echo "<span><strong>Class of: </strong>".$row["gradDate"]."</span><br>";
            echo "<span><strong>College Interests: </strong>".$row["collegeInterest"]."</span><br>";
            echo "<span><strong>Career Aspirations: </strong>".$row["careerAspirations"]."</span><br>";
            echo "<span><strong>Questions and Concerns: </strong>".$row["concerns"]."</span><br>";
            echo "<span><strong>--Emergency Contact Info-- </strong><br>";
            echo "<span><strong>Parent/Guardian Name: </strong>".$row["parentName"]."</span><br>";
            echo "<span><strong>Relationship: </strong>".$row["parentRelationship"]."</span><br>";
            echo "<span><strong>Parent/Guardian Email: </strong>".$row["parentEmail"]."</span><br>";
            echo "<span><strong>Parent/Guardian Phone: </strong>".$row["parentPhone"]."</span><br>";

            foreach ($_POST as $key => $value){
                if(is_array($value)){
                    foreach ($value as $k => $v){
                        $email_body.= $key.': '.$v."\r\n";
                    }
                }else{
                    $email_body.= $key.': '.$value."\r\n";
                }
            }

            //$success = mail($to, $email_subject, $email_body, $headers);
            /*echo ($success ?  "<script>console.log('success');</script>" :
            "<script>console.log('failure');</script>" );*/
        }else{
            echo mysqli_error($cnxn);
            echo "<p>Something went wrong. Please try again!</p>";
        }

        return;
    }
}else{
    echo "<p>Please fill out our form.</p>";
}

//test push
?>

<?php
include "../php/footer.php";
?>
</body>
</html>
