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
require "../php/idaydreamDBconnect.php";
include "../php/header.php";
?>
<link rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">



<title>Dreamer Summary Page</title>
</head>
<body>

    <table id="myTable" class="display">
        <thead>
        <?php
        $columnSQL = "SELECT * FROM Dreamer LIMIT 1";
        $columnResult = mysqli_query($cnxn, $columnSQL);
        while ($row = mysqli_fetch_assoc($columnResult)){
            echo "<tr>";
            foreach ($row as $k => $v){
                echo "<th>$k</th>";
            }
            echo "</tr>";
        }
        ?>
        </thead>
        <tbody>
        <?php
        $dataSQL = "SELECT * FROM Dreamer ORDER BY dreamerID DESC";
        $dataResult = mysqli_query($cnxn, $dataSQL);
        while ($row2 = mysqli_fetch_assoc($dataResult)){
            echo "<tr>";
            foreach ($row2 as $k => $v){
                echo "<td>$v</td>";
            }
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
<?php
    include "../php/footer.php";
?>
<script type="text/javascript"
        charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>
</body>
</html>