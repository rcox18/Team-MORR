<?php
session_start();
//Search and execute php files for error debugger, connection to database and header
include "../php/errors.php";
//if the user is not logged in, redirect
if (!isset($_SESSION['username'])) {
    //if user didn't arrive from index page
    if (!isset($_POST['page-source'])){
        header("location: ../index.php");
    }else{
        $_SESSION['page-destination'] = $_POST['page-source'];
    }
    header("location: login.php");
}
require "../php/idaydreamDBconnect.php";
include "../php/header.php";

//<!--
//    Filename: welcome-confirmation-page.php
//    By: Team MORR
//	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
//	10/30/2019
//	url: http://team-morr.greenriverdev.com/pages/welcome-confirmation-page.php
//	The confirmation page when volunteer-form.html is submitted successfully. Sends email containing the submitted data.
//-->
?>

<!--Link CDN  for use of jQuery table-->
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../styles/sign-up-form.css" type="text/css">
<!--Title card for tab-->
<title>Dreamer Summary Page</title>
</head>

<body>
<div class="container">
    <div class="jumbotron jumbotron-fluid mb-3 pr-2">
        <img src="//static1.squarespace.com/static/5dabc823c0e45245a9c250cd/t/5dacd1ebfe152f3a7aa1de79/1572281708171/?format=1500w"
             alt="iD.A.Y. Dream" class="img-fluid img-thumbnail rounded float-left">
        <h1 class="display-4 font-weight-bold">Dreamer Summary</h1>
    </div>
    <div class="form-group form-inline mt-4">
        <label for="view-select" class="control-label mr-2">Status View:</label>
        <form action="#" method="post" id="view-select">
            <input class="btn btn-primary" type="submit" id="submit-selected-view" name="view" value="All">
            <input class="btn btn-primary" type="submit" id="submit-selected-view" name="view" value="Active">
            <input class="btn btn-primary" type="submit" id="submit-selected-view" name="view" value="Inactive">
            <input class="btn btn-primary" type="submit" id="submit-selected-view" name="view" value="Pending">
        </form>
    </div>
    <!-- Construct table to display a summary of dreamers that have submitted to the database, via the volunteer page-->
    <table id="myTable" class="display table table-striped ">
        <thead class="thead-dark">
        <?php
        //Create Query that selects the column names
        $columnSQL = "SELECT Dreamer.dreamerID, Dreamer.name, Dreamer.active, Dreamer.submissionDate AS 'Submission Date', 
                      Dreamer.email, Dreamer.phone, Dreamer.dob, Dreamer.gradDate, Dreamer.gender, Dreamer.pronouns, 
                      Dreamer.otherRace, Dreamer.snacks, Dreamer.collegeInterest, Dreamer.careerAspirations, 
                      Dreamer.concerns, Ethnicity.choice AS ethnicity, Dreamer.parentName, Dreamer.parentRelationship, 
                      Dreamer.parentEmail, Dreamer.parentPhone FROM Dreamer 
                      INNER JOIN Ethnicity 
                      ON Dreamer.ethnicityID = Ethnicity.ethnicityID 
                      LIMIT 1";
        //Retrieve column names from database
        $columnResult = mysqli_query($cnxn, $columnSQL);
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
        if (isset($_POST['view'])){
            if ($_POST['view'] == 'Active'){
                //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
                $dataSQL = "SELECT Dreamer.dreamerID, Dreamer.name, Dreamer.active, DATE_FORMAT(Dreamer.submissionDate, '%M %d, %Y'), Dreamer.email, Dreamer.phone, 
                            Dreamer.dob, Dreamer.gradDate, Dreamer.gender, Dreamer.pronouns, Dreamer.otherRace, 
                            Dreamer.snacks, Dreamer.collegeInterest, Dreamer.careerAspirations, Dreamer.concerns, 
                            Ethnicity.choice AS ethnicity, Dreamer.parentName, Dreamer.parentRelationship, 
                            Dreamer.parentEmail, Dreamer.parentPhone 
                            FROM Dreamer 
                            INNER JOIN Ethnicity 
                            ON Dreamer.ethnicityID = Ethnicity.ethnicityID
                            WHERE Dreamer.active = 'active'";

            }elseif ($_POST['view'] == 'Inactive'){
                //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
                $dataSQL = "SELECT Dreamer.dreamerID, Dreamer.name, Dreamer.active, DATE_FORMAT(Dreamer.submissionDate, '%M %d, %Y'), Dreamer.email, Dreamer.phone, 
                            Dreamer.dob, Dreamer.gradDate, Dreamer.gender, Dreamer.pronouns, Dreamer.otherRace, 
                            Dreamer.snacks, Dreamer.collegeInterest, Dreamer.careerAspirations, Dreamer.concerns, 
                            Ethnicity.choice AS ethnicity, Dreamer.parentName, Dreamer.parentRelationship, 
                            Dreamer.parentEmail, Dreamer.parentPhone 
                            FROM Dreamer 
                            INNER JOIN Ethnicity 
                            ON Dreamer.ethnicityID = Ethnicity.ethnicityID
                            WHERE Dreamer.active = 'inactive'";
            }elseif ($_POST['view'] == 'Pending'){
                //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
                $dataSQL = "SELECT Dreamer.dreamerID, Dreamer.name, Dreamer.active, DATE_FORMAT(Dreamer.submissionDate, '%M %d, %Y'), Dreamer.email, Dreamer.phone, 
                            Dreamer.dob, Dreamer.gradDate, Dreamer.gender, Dreamer.pronouns, Dreamer.otherRace, 
                            Dreamer.snacks, Dreamer.collegeInterest, Dreamer.careerAspirations, Dreamer.concerns, 
                            Ethnicity.choice AS ethnicity, Dreamer.parentName, Dreamer.parentRelationship, 
                            Dreamer.parentEmail, Dreamer.parentPhone 
                            FROM Dreamer 
                            INNER JOIN Ethnicity 
                            ON Dreamer.ethnicityID = Ethnicity.ethnicityID
                            WHERE Dreamer.active = 'pending'";
            }else{
                //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
                $dataSQL = "SELECT Dreamer.dreamerID, Dreamer.name, Dreamer.active, DATE_FORMAT(Dreamer.submissionDate, '%M %d, %Y'), Dreamer.email, Dreamer.phone, 
                            Dreamer.dob, Dreamer.gradDate, Dreamer.gender, Dreamer.pronouns, Dreamer.otherRace, 
                            Dreamer.snacks, Dreamer.collegeInterest, Dreamer.careerAspirations, Dreamer.concerns, 
                            Ethnicity.choice AS ethnicity, Dreamer.parentName, Dreamer.parentRelationship, 
                            Dreamer.parentEmail, Dreamer.parentPhone 
                            FROM Dreamer 
                            INNER JOIN Ethnicity 
                            ON Dreamer.ethnicityID = Ethnicity.ethnicityID";
            }
        }else{
            //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
            $dataSQL = "SELECT Dreamer.dreamerID, Dreamer.name, Dreamer.active, DATE_FORMAT(Dreamer.submissionDate, '%M %d, %Y'), Dreamer.email, Dreamer.phone, 
                        Dreamer.dob, Dreamer.gradDate, Dreamer.gender, Dreamer.pronouns, Dreamer.otherRace, 
                        Dreamer.snacks, Dreamer.collegeInterest, Dreamer.careerAspirations, Dreamer.concerns, 
                        Ethnicity.choice AS ethnicity, Dreamer.parentName, Dreamer.parentRelationship, 
                        Dreamer.parentEmail, Dreamer.parentPhone 
                        FROM Dreamer 
                        INNER JOIN Ethnicity 
                        ON Dreamer.ethnicityID = Ethnicity.ethnicityID";
        }

        //Retrieve the data from the database
        $dataResult = mysqli_query($cnxn, $dataSQL);
        //Iterate so long as we have data to pull
        while ($row2 = mysqli_fetch_assoc($dataResult)){
            //Construct rows to insert retrieved data
            echo "<tr>";
            //Iterate through the array to display each data set related to each column
            foreach ($row2 as $k => $v){
                if ($k == 'dreamerID'){
                    $dreamerID = $v;
                }
                if ($k == 'active'){
                    echo "<td>
                            <select class='active' data-did='$dreamerID'> 
                                <option ";  echo $v == 'pending' ? "selected": ""; echo ">Pending</option>
                                <option ";  echo $v == 'active' ? "selected": ""; echo ">Active</option>
                                <option ";  echo $v == 'inactive' ? "selected": ""; echo ">Inactive</option>
                            </select>
                          </td>";
                }else{
                    echo "<td>$v</td>";
                }
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <form class="d-inline" action="emailAllForm.php" method="post" id="email-active-dreamers" name="email-active-dreamers">
        <input class="btn btn-primary" type="submit" id="submit-page-source" name="page-source" value="Email active Dreamers">
    </form>
    <a href="logout.php" class="btn btn-secondary">Sign Out</a>
</div>

<?php
    //Search and execute footer php file
    include "../php/footer.php";
?>
    <!--Link javascript CDN for use of jQuery table-->
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script>
        $('.active').on('change', function () {
            var active = $(this).val();
            var dreamerID = $(this).attr('data-did');
            //alert("Vol ID: " + volID +" active: " + active);
            $.post("updateDreamerStatus.php", {active: active, dreamerID: dreamerID});
        });
    </script>
    <!--Call necessary DataTable method to format table to jQuery Data Table-->
    <script src="../scripts/dataTableJS.js"></script>
</body>
</html>