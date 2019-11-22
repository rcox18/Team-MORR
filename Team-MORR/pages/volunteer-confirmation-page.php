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
//generating messages
$fName = $_POST["first-name"];
$lName = $_POST["last-name"];
$info = "<p>";


if (!empty($_POST)){

    require "../php/idaydreamDBconnect.php";

    /*----CHECKING CONNECTION FIRST----*/
    if ($cnxn){
        $isValid= true;
        /*----Begin Validation----*/

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
        /*$sql = "INSERT INTO Dreamer (name, dob, gradDate, gender, pronouns, otherRace, phone, email, snacks, collegeInterest, careerAspirations, concerns, ethnicityID) VALUES ('$fName $lName', '$dob', '$gradYear', '$gender', '$pronouns', '$otherRace', '$phone', '$email', '$snacks', '$collegeInterests', '$careerAspirations', '$qAndConcerns', '$raceEthnicity');";

        $result = mysqli_query($cnxn, $sql);

        if($result) {
            /*----DISPLAY SUBMITTED INFO BACK TO APPLICANT----*//*

            $sql2 = "SELECT * FROM Dreamer WHERE name = '$fName $lName' AND dob = '$dob';";
            $sql3 = "SELECT choice FROM Ethnicity WHERE ethnicityID = '$raceEthnicity';";

            $result2 = mysqli_query($cnxn, $sql2);
            $result3 = mysqli_query($cnxn, $sql3);

            $row = mysqli_fetch_assoc($result2);
            $row2 = mysqli_fetch_assoc($result3);

            echo "<h1>Your Application Has Been Submitted</h1>
            <p>$fName, thank you for your interest in supporting our youth.
            Your information has been sent to iD.A.Y. dream.</p>";

            echo "<b>Name: ".$row["name"]."<br>";
            echo "<b>Date of Birth: ".$row["dob"]."<br>";
            echo "<b>Identifies as: ".$row["gender"]."<br>";
            if($pronouns != ""){
                echo "<b>Preferred Pronouns: ".$row["pronouns"]."<br>";
            }
            if ($raceEthnicity != "7"){
                echo "<b>Race/Ethnicity: ".$row2["choice"]."<br>";
            }else{
                echo "<b>Race/Ethnicity: ".$row["otherRace"]."<br>";
            }

            echo "<b>Preferred Snacks: ".$row["snacks"]."<br>";
            echo "<b>Email: ".$row["email"]."<br>";
            echo "<b>Phone: ".$row["phone"]."<br>";
            echo "<b>Class of: ".$row["gradDate"]."<br>";
            echo "<b>College Interests: ".$row["collegeInterest"]."<br>";
            echo "<b>Career Aspirations: ".$row["careerAspirations"]."<br>";
            echo "<b>Questions and Concerns: ".$row["concerns"]."<br>";*/

            /*-----------------*/

            //adds the raw data to the display
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

            //finish and print confirmation message
            $info .= "</p>";
            echo $info;
            //sends siteEmail
            /*$success = mail($to, $email_subject, $email_body, $headers);*/
            }else{
                echo mysqli_error($cnxn);
                echo "<p>Something went wrong. Please try again!</p>";
            }

    /*}*/
}else{
    echo "<p>Please fill out our form.</p>";
}

include "../php/footer.php";
?>
</body>
</html>