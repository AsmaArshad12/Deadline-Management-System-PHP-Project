<?php 

include "../dbconnection.php";

$Id=$_GET['id'];
$query="delete from tasks where Task_ID='$Id'";
$msg= mysqli_query($con, $query);
if($msg)
{
   echo "<script>window.location='View_Task.php';alert('Deleted Successfully');</script>";
}
else
{
   echo "<script>window.location='Delete_Task.php';alert('Error Message');</script>";
}

?>
