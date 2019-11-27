<!--
    Filename: volunteer-confirmation-page.php
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	10/30/2019
	url: http://team-morr.greenriverdev.com/pages/welcome-confirmation-page.php
	The following page displays a table that holds all information of submissions from potential volunteers
	This includes contact information, availability, interests, and motivations for working  with the organization.
-->

<?php
//Search and execute php files for error debugger, connection to database and header
include "../php/errors.php";
require "../php/idaydreamDBconnect.php";
include "../php/header.php";
?>

<!--Link CDN  for use of jQuery table-->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">

<!--Title card for tab-->
<title>Email All Page</title>
</head>

<body>
<div class="container">
    <?php
    if (isset($_POST)){
        if (isset($_POST['submit-email'])){
            if($_POST['submit-email'] == "Send to Volunteers" OR $_POST['submit-email'] == "Send to Dreamers"){
                if ($cnxn){
                    //create and send emails
                    $isValid = true;

                    if (empty($_POST['subject'])){
                        echo "<p>Please enter a Subject.</p>";
                        $isValid = false;
                    }else{
                        $subject = $_POST['subject'];
                    }

                    if (empty($_POST['body'])){
                        echo "<p>Please enter a Body.</p>";
                        $isValid = false;
                    }else{
                        $body = $_POST['body'];
                    }

                    if ($isValid){
                        $from = "rcox18@mail.greenriver.edu";
                        $headers = "From: $from\r\n";
                        $headers .= "Reply-To: $from \r\n";
                        if ($_POST['submit-email'] == "Send to Volunteers"){
                            $tableName = "Volunteer";
                        }else{
                            $tableName = "Dreamer";
                        }

                        $sql = "SELECT email from $tableName";
                        $result = mysqli_query($cnxn, $sql);

                        if ($result){
                            $count = 0;
                            while($row = mysqli_fetch_assoc($result)){
                                foreach ($row AS $k => $v){
                                    $to = $v;
                                    $success = mail($to, $subject, $body, $headers);
                                    if ($success){
                                        $count++;
                                    }
                                }
                            }

                            echo "<p>$count emails were successfully sent.</p>";
                        }

                    }


                }else{
                    echo "Connection error...try again.";
                }
            }else{
                echo "Something fishy is going on...try again.";
            }
        }elseif (isset($_POST['page-source'])){
            if ($_POST['page-source'] == "Email all Volunteers" OR $_POST['page-source'] == "Email all Dreamers"){
                echo "<h1>".$_POST['page-source']."</h1>";
                if ($_POST['page-source'] == "Email all Volunteers"){
                    $recipients = "Volunteers";
                }else{
                    $recipients = "Dreamers";
                }

                echo "
                      <form action='emailAllForm.php' method='post' id='email-form' name='email-form'>
                        <div class='form-group'>
                           <label for='subject'>Subject</label>
                           <input class='form-control' type='text' id='subject' name='subject'><br>
                        </div>
                        <div class='form-group'>
                           <label for='body'>Body</label>
                           <textarea class='form-control' id='body' name='body' rows='10'></textarea><br>                           
                        </div>
                        <div class='text-center'>
                            <input class='btn btn-primary' type='submit' name='submit-email' id='submit-email' value='Send to {$recipients}'>
                        </div>
                      </form>";
            }else{
                echo "Something fishy is going on...try again.";
            }
        }else{
            echo "Something fishy is going on...try again.";
        }
    }else{
        echo "Why are you here?";
    }
    ?>
</div>
<?php
//Search and execute footer php file
include "../php/footer.php";
?>
<!--Link javascript CDN for use of jQuery table-->
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<!--Call necessary DataTable method to format table to jQuery Data Table-->
<script src="../scripts/dataTableJS.js"></script>
</body>
</html>
