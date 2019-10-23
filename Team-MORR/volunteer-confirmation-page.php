<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Volunteer Application Success</title>
</head>
<body>
 <?php
     foreach ($_POST as $key => $value) {
         if(is_array($value)){
             foreach ($value as $k => $v) {
                 echo '<p>'.$key.': '.$v.'</p>';
             }
         }
         else{
             echo '<p>'.$key.': '.$value.'</p>';
         }
     }
 ?>
</body>
</html>