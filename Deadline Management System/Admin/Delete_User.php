<?php 

include "../dbconnection.php";

$Id=$_GET['id'];
$query="delete from users where UserID='$Id'";
$msg= mysqli_query($con, $query);
if($msg)
{
   echo "<script>window.location='View_User.php';alert('Deleted Successfully');</script>";
}
else
{
   echo "<script>window.location='Delete_User.php';alert('Error Message');</script>";
}

?>