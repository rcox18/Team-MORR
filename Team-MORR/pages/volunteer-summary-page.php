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
<title>Volunteers Summary Page</title>
</head>

<body>
<div class="container">
    <!-- Construct table to display a summary of dreamers that have submitted to the database, via the volunteer page-->
    <table id="myTable" class="display table table-striped ">
        <thead class="thead-dark">
        <?php
        //Create Query that selects the column name
        $volunteerColumnSQL = "SELECT v.volunteerID, v.name AS VolunteerName, v.email AS VolunteerEmail, v.phone AS VolunteerPhone, 
        v.address, v.shirtSize, v.mailingList, v.motivation, v.POBox, v.city, v.state, v.zip, v.interests, v.hearAboutUs, v.rolesOfInterests,
        v.previousExp, v.expMention, v.availability, v.active, v.ref1, v.ref2, v.ref3
        FROM Volunteer v LIMIT 1";
        //Retrieve column names from database
        $columnResult = mysqli_query($cnxn, $volunteerColumnSQL);
        //Iterate so long as we have data to pull
        while ($row = mysqli_fetch_assoc($columnResult)){
            //Construct the columns with the names
            echo "<tr>";
            //Iterate through the array and display each column name in a table head
            foreach ($row as $k => $v){
                echo "<th>$k</th>";
            }
            echo "</tr>";
        }
        ?>
        </thead>
        <tbody>
        <?php
        //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
        $volunteerDataSQL = "SELECT v.volunteerID, v.name, v.email, v.phone, 
        v.address, v.shirtSize, v.mailingList, v.motivation, v.POBox, v.city, 
        v.state, v.zip, v.interests, v.hearAboutUs, v.rolesOfInterests,
        v.previousExp, v.expMention, v.availability, v.active
        FROM Volunteer v";
        //Create query to retrieve each individual ref, up to 3
        $ref1DataSQL = "SELECT r.name, r.phone, r.email, r.relationship FROM Ref r INNER JOIN Volunteer WHERE r.refID = Volunteer.ref1";
        $ref2DataSQL = "SELECT r.name, r.phone, r.email, r.relationship FROM Ref r INNER JOIN Volunteer WHERE r.refID = Volunteer.ref2";
        $ref3DataSQL = "SELECT r.name, r.phone, r.email, r.relationship FROM Ref r INNER JOIN Volunteer WHERE r.refID = Volunteer.ref3";
        //Retrieve the data from the database
        $dataResult = mysqli_query($cnxn, $volunteerDataSQL);
        $ref1Result = mysqli_query($cnxn, $ref1DataSQL);
        $ref2Result = mysqli_query($cnxn, $ref2DataSQL);
        $ref3Result = mysqli_query($cnxn, $ref3DataSQL);
        //Iterate so long as we have data to pull
        while ($row2 = mysqli_fetch_assoc($dataResult) AND $row3 = mysqli_fetch_assoc($ref1Result)
            AND $row4 = mysqli_fetch_assoc($ref2Result) AND $row5 = mysqli_fetch_assoc($ref3Result)){
            //Construct rows to insert retrieved data
            echo "<tr>";
            //Iterate through the array to display each data set related to each column
            foreach ($row2 as $k => $v) {
                echo "<td>$v</td>";
            }
            //Iterate through reference 1's info
            $results1 = "|";
            foreach ($row3 as $k => $v) {
                $results1 .= $v." | ";
            }
            echo "<td>$results1</td>";
            //Iterate through reference 2's info
            $results2 = "|";
            foreach ($row4 as $k => $v) {
                $results2 .= $v." | ";
            }
            echo "<td>$results2</td>";
            //Iterate through reference 3's info
            $results3 = "|";
            foreach ($row5 as $k => $v) {
                $results3 .= $v." | ";
            }
            echo "<td>$results3</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <form action="emailAllForm.php" method="post" id="email-active-volunteers" name="email-active-volunteers">
        <input class="btn btn-primary" type="submit" id="submit-page-source" name="page-source" value="Email active Volunteers">
    </form>
</div>

<a href="send-email.php"><button class="success">Send Email</button></a>

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
