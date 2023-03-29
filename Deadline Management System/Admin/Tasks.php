<?php 

include '../dbconnection.php';
error_reporting(0);

if (isset($_POST['submit'])) {
 
     $filter_column= $_POST['filter_column'];
     $operator= $_POST['operator'];
     $keyword1 = $_POST['txt_keyword1'];
     $keyword2 = $_POST['txt_keyword2'];
  try
  {
    if($operator=="BETWEEN")
    {
      $From = "'" . $keyword1 . "'";
      $To  = "'" . $keyword2 . "'";

      if (is_numeric($keyword1) && is_numeric($keyword2))
      {
           $query =  "Select * from tasks where" . " ". $filter_column . " " . $operator . " " . $keyword1 . " " . "AND" . " " . $keyword2;
           $search_result= mysqli_query($con, $query);
      }
      else
      {
         $query =  "Select * from tasks where" . " ". $filter_column . " " . $operator . " " . $From . " " . "AND" . " " . $To;
         $search_result= mysqli_query($con, $query);       
      }
  
      if(mysqli_num_rows($search_result)<=0)
      {
        $search_error = "No result Found";
      }
    }
    else if ($operator=="Starts with")
    {
      $query = "Select * from tasks where" . " ". $filter_column . " " . "LIKE" . " " . "'" . $keyword1 ."%" . "'";
         $search_result= mysqli_query($con, $query); 
     
      if(mysqli_num_rows($search_result)<=0)
      {
        $search_error = "No result Found";
      }
    }
    else if ($operator=="Ends with")
    {
       $query = "Select * from tasks where" . " ". $filter_column . " " . "LIKE" . " " . "'" ."%" . $keyword1 . "'";
         $search_result= mysqli_query($con, $query); 
     
      if(mysqli_num_rows($search_result)<=0)
      {
        $search_error = "No result Found";
      }
    }
    else
    {
      if (is_numeric($keyword1))
      {
        $query= "Select * from tasks where" . " ". $filter_column . $operator . $keyword1;
        $search_result= mysqli_query($con, $query);
      }
      else
      {
        $query= "Select * from tasks where" . " ". $filter_column . $operator . "'" . $keyword1 . "'";
        $search_result= mysqli_query($con, $query);
      }

      if(mysqli_num_rows($search_result)<=0)
      {
        $search_error = "No result Found";
      }
    } 

  }
    catch (exception $e) {
    //code to handle the exception
    }
}
else 
{
    $query = "SELECT * FROM tasks";
    $search_result =  mysqli_query($con, $query);
}

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>View Tasks</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../assets/css/style.min.css" rel="stylesheet">
</head>

<body>
    
    <!--<div class="preloader">
      <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>-->
    

    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">     
       
       <?php 
       include 'sidebar.php'
       ?>
    
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">All Users</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">All Users</h1> 
                    </div>
                    <div class="col-6">
                        
                    </div>
                </div>
            </div>

            <form method="post">
                <div class="container-fluid">
                 <div class="row mb-4">
                         <div class="col-lg-3">
                         <select name="filter_column" class="form-control" required>

                            <?php
                            include '../dbconnection.php';
                            $query = $con->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tasks'");

                            while($row = mysqli_fetch_array($query)){  
                            ?>

                            <option value="<?php echo $row['COLUMN_NAME'];?>"><?php echo $row['COLUMN_NAME'];?>
                            </option>

                             <?php } ?>

                          </select>
                        </div>


                        <div class="col-lg-2">
                          <select name="operator" class="form-control" required>
                            <option value="">Select operator</option>
                            <option value="<"><</option>
                            <option value=">">></option>
                            <option value="=">= </option>
                            <option value="<="><= </option>
                            <option value=">=">>= </option>
                            <option value="Starts with">Starts with</option>
                            <option value="Ends with">Ends with </option>
                            <option value="BETWEEN">In between </option>
                          </select>
                        </div>

                      

                        <div class="col-lg-2">
                           <input type="text" name="txt_keyword1" class="form-control" placeholder="Keyword 1" required>
                        </div>

                        <div class="col-lg-2">
                           <input type="text" name="txt_keyword2" class="form-control" placeholder="Keyword 2">
                        </div>

                        <div class="col-lg-2">
                            <input type="submit" name="submit" value="Search" class="btn btn-primary">
                        </div>
                 </div>

                <span class="text-danger h5"><?php if(isset($search_error)) {echo $search_error;} ?>
                </span>

                    <div class="col-lg-11 mb-5 mt-5">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th>Status_Trigger</th>
                                        <th>Grades</th>
                                        <th>Payment_Status</th>
                                        <th>Start_Date</th>
                                        <th>Client_Name</th>
                                        <th>Price</th>
                                        <th>Recieved_Price</th>
                                        <th>Remaining_Price</th>
                                        <th>Account_Type</th>
                                        <th>Actual_Deadline</th>
                                        <th>Course_Name</th>
                                        <th>Module</th>
                                        <th>Code</th>
                                        <th>Comments</th>
                                        <th>Assigned</th>
                                        <th>Due_Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Team_Lead</th>
                                        <th>Team_Lead_Status</th>                                                 
                                    </tr>
                                                     
        <?php
        while($row= mysqli_fetch_array($search_result))
        {
        ?>
            <tr>
                <td><?php echo $row['Title']; ?></td>
                <td><?php echo $row['Status_Trigger']; ?></td>
                <td><?php echo $row['Grades']; ?></td>
                <td><?php echo $row['Payment_Status']; ?></td>
                <td><?php echo $row['Start_Date']; ?></td>
                <td><?php echo $row['Client_Name']; ?></td>
                <td><?php echo $row['Price']; ?></td>
                <td><?php echo $row['Recieved_Price']; ?></td>
                <td><?php echo $row['Remaining_Price']; ?></td>
                <td><?php echo $row['Account_Type']; ?></td>
                <td><?php echo $row['Actual_Deadline']; ?></td>
                <td><?php echo $row['Course_Name']; ?></td>
                <td><?php echo $row['Module']; ?></td>
                <td><?php echo $row['Code']; ?></td> 
                <td><?php echo $row['Comments']; ?></td>
                <td><?php echo $row['Assigned']; ?></td>
                <td><?php echo $row['Due_Date']; ?></td>
                <td><?php echo $row['Time']; ?></td>
                <td><?php echo $row['Status']; ?></td>     
                <td><?php echo $row['Team_Lead']; ?></td>
                <td><?php echo $row['Team_Lead_Status']; ?></td>
            </tr>

      <?php
     }  
     ?>   
             </table>
           </div>
         </div>
       </form>
     </div>
   </div>
 </body>
</html>