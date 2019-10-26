<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/sign-up-form.css">

    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans&display=swap" rel="stylesheet">
    <title>Volunteer Application Success</title>
</head>
<body>
<?php
$fName = $_POST["first-name"];
$lName = $_POST["last-name"];
$info = "<p>";
$email = "rcox18@mail.greenriver.edu";
$email_body = "Applicant Information --\r\n";
$email_body .= "Name: $fName $lName\r\n";
$email_subject = "New Volunteer application";
$to = $email;
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email \r\n";

echo "<h1>Your Application Has Been Submitted</h1>
            <p>$fName, thank you for your interest in supporting our youth. 
            The following information has been sent to iD.A.Y. dream:</p>";

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
echo $info;
$success = mail($to, $email_subject, $email_body, $headers);
echo ($success ?  "<script>console.log('success');</script>" :
    "<script>console.log('failure');</script>" );
?>
</body>
</html>