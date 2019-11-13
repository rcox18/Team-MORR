<!--
    Filename: welcome-confirmation-page.php
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	10/30/2019
	url: http://team-morr.greenriverdev.com/pages/welcome-confirmation-page.php
	The confirmation page when volunteer-form.html is submitted successfully. Sends email containing the submitted data.
-->

<?php
include "../php/errors.php";

include "../php/header.php";
?>
    <title>Welcome Page Confirmation</title>
</head>
<body>
<?php
$nameRegex = "/^([a-zA-Z' -]+)$/";
$basicTextRegex = "/^([a-zA-Z0-9'\", .()\n&!?-]+)$/";
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
                    echo '<p>Please provide valid identity inputs.</p>';
                    $isValid = false;
                }
            }else{
                echo '<p>Please inform us about your identity.</p>';
                $isValid = false;
            }
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
                echo '<p>Please inform us about you race/ethnicity.</p>';
                $isValid= false;
            }
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
    }else{
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

        echo "<h1>Your Information Has Been Submitted</h1>
            <p>$fName, thank you for telling us a little bit about yourself! This information
            is vital to our goals of best serving our Dreamers. If you see any errors in
            the following submitted info, please contact us ASAP for corrections.</p>";

            /*----ADD TO DATABASE----*/
            $sql = "INSERT INTO Dreamer (name, dob, gradDate, gender, pronouns, otherRace, phone, email, snacks, collegeInterest, careerAspirations, concerns, ethnicityID) VALUES ('$fName $lName', '$dob', '$gradYear', '$gender', '$pronouns', '$otherRace', '$phone', '$email', '$snacks', '$collegeInterests', '$careerAspirations', '$qAndConcerns', '$raceEthnicity');";

            $result = mysqli_query($cnxn, $sql);

            if($result) {
                /*----DISPLAY SUBMITTED INFO BACK TO APPLICANT----*/

                $sql2 = "SELECT * FROM Dreamer WHERE name = '$fName $lName' AND dob = '$dob';";
                $sql3 = "SELECT choice FROM Ethnicity WHERE ethnicityID = '$raceEthnicity';";

                $result2 = mysqli_query($cnxn, $sql2);
                $result3 = mysqli_query($cnxn, $sql3);

                $row = mysqli_fetch_assoc($result2);
                $row2 = mysqli_fetch_assoc($result3);


                echo "Name: ".$row["name"]."<br>";
                echo "Date of Birth: ".$row["dob"]."<br>";
                echo "Identifies as: ".$row["gender"]."<br>";
                if($pronouns != ""){
                    echo "Preferred Pronouns: ".$row["pronouns"]."<br>";
                }
                if ($raceEthnicity != "7"){
                    echo "Race/Ethnicity: ".$row2["choice"]."<br>";
                }else{
                    echo "Race/Ethnicity: ".$row["otherRace"]."<br>";
                }

                echo "Preferred Snacks: ".$row["snacks"]."<br>";
                echo "Email: ".$row["email"]."<br>";
                echo "Phone: ".$row["phone"]."<br>";
                echo "Class of: ".$row["gradDate"]."<br>";
                echo "College Interests: ".$row["collegeInterest"]."<br>";
                echo "Career Aspirations: ".$row["careerAspirations"]."<br>";
                echo "Questions and Concerns: ".$row["concerns"]."<br>";

                foreach ($_POST as $key => $value){
                    if(is_array($value)){
                        foreach ($value as $k => $v){
                            $email_body.= $key.': '.$v."\r\n";
                        }
                    }else{
                        $email_body.= $key.': '.$value."\r\n";
                    }
                }

                /*$success = mail($to, $email_subject, $email_body, $headers);
                echo ($success ?  "<script>console.log('success');</script>" :
                "<script>console.log('failure');</script>" );*/
            }else{
                echo mysqli_error($cnxn);
                echo "there is a problem!";
            }
        return;
    }
}else{
    echo "<p>Please fill out our form.</p>";
}
?>

<?php
include "../php/footer.php";
?>
</body>
</html>
