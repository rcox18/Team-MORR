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

$sql = "SELECT DISTINCT email FROM Dreamer";
//$sql = "SELECT DISTINCT email FROM Volunteer WHERE active = "yes";
$result = mysqli_query($cnxn, $sql);

while($row = mysqli_fetch_assoc($result)) {
    $to = $row['email'];
    echo "Sending email to ".$to;
    echo "<br>";
}

$count = "SELECT COUNT(DISTINCT email) FROM Dreamer"''
//$count = "SELECT COUNT(DISTINCT email) FROM Volunteer WHERE active = "yes";

echo "You successfully sent out " .count ."emails!";

include "../php/footer.php";
?>
</body>
</html>
