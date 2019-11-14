<!--
    Filename: welcome-confirmation-page.php
    By: Team MORR
	Marcos Rivera, Olivia Ringhiser, Raj Dhaliwal, and Robert Cox
	10/30/2019
	url: http://team-morr.greenriverdev.com/pages/welcome-confirmation-page.php
	The confirmation page when volunteer-form.html is submitted successfully. Sends email containing the submitted data.
-->

<?php
//Search and execute php files for error debugger, connection to database and header
include "../php/errors.php";
require "../php/idaydreamDBconnect.php";
include "../php/header.php";
?>

<!--Link CDN  for use of jQuery table-->
<link rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">


<!--Title card for tab-->
<title>Dreamer Summary Page</title>
</head>
<body>
    <!-- Construct table to display a summary of dreamers that have submitted to the database, via the volunteer page-->
    <table id="myTable" class="display table table-striped ">
        <thead class="thead-dark">
        <?php
        //Create Query that selects the column names
        $columnSQL = "SELECT * FROM Dreamer LIMIT 1";
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
        //Create query that selects data stored in each field and display the value each ethnicity rather than the key value
        $dataSQL = "SELECT Dreamer.dreamerID, Dreamer.name, Dreamer.dob, Dreamer.gradDate, Dreamer.gender, Dreamer.pronouns, Dreamer.otherRace, Dreamer.phone, Dreamer.email, Dreamer.snacks, Dreamer.collegeInterest, Dreamer.careerAspirations, Dreamer.concerns, Ethnicity.choice FROM Dreamer INNER JOIN Ethnicity ON Dreamer.ethnicityID = Ethnicity.ethnicityID";
        //Retrieve the data from the database
        $dataResult = mysqli_query($cnxn, $dataSQL);
        //Iterate so long as we have data to pull
        while ($row2 = mysqli_fetch_assoc($dataResult)){
            //Construct rows to insert retrieved data
            echo "<tr>";
            //Iterate through the array to display each data set related to each column
            foreach ($row2 as $k => $v){
                echo "<td>$v</td>";
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
<?php
    //Search and execute footer php file
    include "../php/footer.php";
?>
    <!--Link javascript CDN for use of jQuery table-->
<script type="text/javascript"
        charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <!--Call necessary DataTable method to format table to jQuery Data Table-->
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            "order": [[ 0, "desc" ]],
                "scrollX": true
        });
    } );
</script>
</body>
</html>