  /*Filename: email-confirmation.php
    By Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	11/26/2019
	url http://team-morr.greenriverdev.com/pages/email-confirmation.php*/

<?php
require "../php/idaydreamDBconnect.php";
include "../php/errors.php";
include "../php/header.php";

$siteEmail = "oringhiser@mail.greenriver.edu";
$email_body = $_POST['message'];
$email_subject = $_POST['subject'];
$headers = "From: $siteEmail\r\n";
$headers .= "Reply-To: $siteEmail \r\n";

if ($_POST['sendTo'] == "dreamers") {
    $sql = "SELECT DISTINCT email FROM Dreamer";
    $database = "Dreamer";
}
if ($_POST['sendTo'] == "volunteers") {
    $sql = "SELECT DISTINCT email FROM Volunteer WHERE active = 'yes'";
    $database = "Volunteer";
}

$result = mysqli_query($cnxn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $to = $row['email'];
    echo "Sending email to ".$to;
    $success = mail($to, $subject, $body, $headers);
    if (!$success){
        echo "Sending email to ".$to ."has failed";
    }

if ($database == "Dreamer") {
    $count = "SELECT COUNT(DISTINCT email) FROM Dreamer";
}

if ($database == "Volunteer") {
    $count = "SELECT COUNT(DISTINCT email) FROM Volunteer WHERE active = 'yes'";
}

echo "You successfully sent out " .count ."emails!";

include "../php/footer.php";
?>
</body>
</html>
