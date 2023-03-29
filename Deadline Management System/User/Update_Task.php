<?php
include "../dbconnection.php";

if(isset($_POST['submit']))
{

  $id = $_POST['id'];
  $Team_Lead = $_POST['team_Lead'];
  $Team_Lead_Status = $_POST['team_Lead_Status'];

  $query = "Update tasks set Team_Lead='$Team_Lead', Team_Lead_Status='$Team_Lead_Status' where Task_ID='$id'";
  $update=mysqli_query($con, $query);

  if($update)
  {
      echo "<script>window.location='View_Task.php';alert('Updated Successfully');</script>";  
  }
  else
  {
      echo "<script>window.location='Update_Task.php';alert('InValid Data');</script>";
  }

}
?>

<!DOCTYPE html>
<html>

<head>
   <title>Update Task</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../assets/css/style.min.css" rel="stylesheet">
</head>

<body>
 
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    
    <?php
        include 'sidebar.php';
        include '../dbconnection.php';
        $Id=$_GET['id'];
        $query="select * from tasks where Task_ID='$Id'";
        $result= mysqli_query($con, $query);
        while($row=mysqli_fetch_array($result))
        {
         ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Update Task</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Update Task</h1> 
                    </div>
                    <div class="col-6">
                        
                    </div>
                </div>
            </div>
        
            <div class="container-fluid">    
                <div class="row">
                    <div class="col-lg-12 col-xlg-12 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material mx-2" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['Task_ID']; ?>">
                                    <div class="form-group">
                                        <label class="col-md-12">Team Lead</label>
                                        <div class="col-md-12">
                                            <input type="text" name="team_Lead" value="<?php echo $row['Team_Lead']; ?>" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Team Lead Status</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" name="team_Lead_Status" value="<?php echo $row['Team_Lead_Status']; ?>"
                                            >
                                        </div>
                                    </div>
                                            
                                                    
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="submit" value="Update" class="btn btn-success text-white">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <?php 
           }
           ?>  
     </div>
  </body>
</html>