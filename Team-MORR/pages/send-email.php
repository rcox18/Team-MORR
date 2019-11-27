  /*Filename: send-email.php
    By Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	11/26/2019
	url http://team-morr.greenriverdev.com/pages/send-email.php*/

<?php
require "../php/idaydreamDBconnect.php";
include "../php/errors.php";
include "../php/header.php";
?>

    <form action ="email-confirmation.php" id="send-email" name="send-email" method="post">
        <label for="subject">Subject<span class="text-danger err" id="subject-err">*required</span></label>
        <input type="text" id="subject" name="subject" class="form-control required-input"><br>

        <label for="message">Message<span class="text-danger err" id="message-err">*required</span></label>
        <textarea class="form-control" id="message" name="message" class="form-control required-input">
        </textarea><br>

        <button id="send" class="btn btn-success">Send Email</button>
    </form>

include "../php/footer.php";
