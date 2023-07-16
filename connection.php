<!DOCTYPE html>
<html>
<body>
 
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dairy";
 
// Create connection in mysqli
 
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
//Check connection in mysqli
if(!$conn){
die("Error on the connection" .mysqli_error());
}
else
{
//  echo "Hay dairy Connected Sucessfully ";
}
?>
 
</body>
</html>