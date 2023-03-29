<?php 

include '../dbconnection.php';

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
       $query =  "Select Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status from tasks where" . " ". $filter_column . " " . $operator . " " . $keyword1 . " " . "AND" . " " . $keyword2;
       $search_result= mysqli_query($con, $query);
  }
  else
  {
     $query =  "Select Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status from tasks where" . " ". $filter_column . " " . $operator . " " . $From . " " . "AND" . " " . $To;
     $search_result= mysqli_query($con, $query);       
  }

  if(mysqli_num_rows($search_result)<=0)
  {
    $search_error = "No result Found";
  }
}
else if ($operator=="Starts with")
{
  $query = "Select Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status from tasks where" . " ". $filter_column . " " . "LIKE" . " " . "'" . $keyword1 ."%" . "'";
     $search_result= mysqli_query($con, $query); 
 
  if(mysqli_num_rows($search_result)<=0)
  {
    $search_error = "No result Found";
  }
}
else if ($operator=="Ends with")
{
   $query = "Select Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status from tasks where" . " ". $filter_column . " " . "LIKE" . " " . "'" ."%" . $keyword1 . "'";
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
    $query= "Select Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status from tasks where" . " ". $filter_column . $operator . $keyword1;
    $search_result= mysqli_query($con, $query);
  }
  else
  {
    $query= "Select Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status from tasks where" . " ". $filter_column . $operator . "'" . $keyword1 . "'";
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
$query = "SELECT Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status FROM tasks";
$search_result =  mysqli_query($con, $query);
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Tasks</title>
  //  <?php 
     //  include 'User_sidebar.php'
   //    ?>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../assets/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper" > 
    
        <div class="page-wrapper">
            <div class="page-breadcrumb" style="margin-bottom: 0px; padding-bottom: 0px;">
                <div class="row align-items-center">
                    <div class="col-6">                        
                        <h2 class="mb-0 fw-bold">View Tasks</h2> 
                    </div>
                    <div class="col-2">
                    
                    </div>
                    <div class="col-4" style="text-align: right;">
                    
                    </div>
                </div>
            </div>

            <form method="post" style="font-size: 13px;"> 
                <div class="container-fluid">
                <div class="row mb-4">
                         <div class="col-lg-3">
                         <select name="filter_column" class="form-control" required>


                            <!--  <?php
                            include '../dbconnection.php';
                            $query = $con->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'tasks'");

                            while($row = mysqli_fetch_array($query)){  
                            ?>

                             <option value="<?php echo $row['COLUMN_NAME'];?>"><?php echo $row['COLUMN_NAME'];?>
                            </option>

                             <?php } ?> -->
                            

                             <option value="Code">Code</option>
                             <option value="Comments">Comments</option>
                             <option value="Assigned">Assigned</option>
                             <option value="Due_Date">Due Date</option>
                             <option value="Time">Time</option>
                             <option value="Status">Status</option>
                             <option value="Team_Lead">Team Lead</option>
                             <option value="Team_Lead_Status">Team Lead Status</option>
                             

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
                    <div class="col-lg-12 mb-6 mt-5">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Code</th>                                                                                
                                        <th>Comments</th>
                                        <th>Assigned</th>
                                        <th>Due Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Team Lead</th>
                                        <th>Team Lead Status</th> 
                                        <th>Update</th>                                            
                                    </tr>
                                                     
       <?php
        include "../dbconnection.php";
        $query="Select Task_ID, Code, Comments, Assigned, Due_Date, Time, Status, Team_Lead, Team_Lead_Status FROM tasks"; 
        $x= mysqli_query($con, $query);
        while($row= mysqli_fetch_array($x))
       {
       ?>
            <tr>
                <td><?php echo $row['Code']; ?></td>                               
                <td><?php echo $row['Comments']; ?></td>
                <td><?php echo $row['Assigned']; ?></td>
                <td><?php echo $row['Due_Date']; ?></td>
                <td><?php echo $row['Time']; ?></td>
                <td>
                <?php
                  if(($row['Time'] > $row['Due_Date']) && ($row['Status'] != 'Submitted') && ($row['Status'] != 'Done') && ($row['Status'] != 'Updated') && ($row['Status'] != 'Edit'))
                  {?>
                    <label class="badge bg-danger"><?php echo "Past Due Danger" ?></label>
                  <?php
                  }
                  elseif(($row['Time'] == $row['Due_Date']) && ($row['Status'] != 'Submitted') && ($row['Status'] != 'Done') && ($row['Status'] != 'Updated') && ($row['Status'] != 'Edit'))
                  {?>
                    <label class="badge" style="background-color: #FFE900"><?php echo "Critical" ?></label>
                  <?php
                  }
                  else{
                   if($row['Status']=='Critical')
                   {?> 
                   <label class="badge" style="background-color: #FFE900;"><?php echo $row['Status']; ?></label>
                   <?php
                   }elseif($row['Status']=='Highly Sensitive')
                   {?> 
                     <label class="badge bg-danger"><?php echo $row['Status']; ?></label>
                     <?php
                   }
                   elseif($row['Status']=='Past Due Danger')
                   {?> 
                     <label class="badge" style="background-color: #0000FF;"><?php echo $row['Status']; ?></label>
                     <?php
                   }                  
                   elseif($row['Status']=='Submitted')
                   {?> 
                     <label class="badge bg-success"><?php echo $row['Status']; ?></label>
                     <?php
                   }                 
                   elseif($row['Status']=='Edit')
                   {?> 
                     <label class="badge bg-orange"><?php echo $row['Status']; ?></label>
                     <?php
                   }
                   elseif($row['Status']=='Updated')
                   {?> 
                     <label class="badge" style="background-color: #FF69B4;"><?php echo $row['Status']; ?></label>
                     <?php
                   }                  
                   elseif($row['Status']=='Done')
                   {?> 
                     <label class="badge" style="background-color: #0000FF;"><?php echo $row['Status']; ?></label>
                     <?php
                   }
                  }
                  ?>
              </td>     
                <td><?php echo $row['Team_Lead']; ?></td>
                <td><?php echo $row['Team_Lead_Status']; ?></td>

                <td><a role="button" href="Update_Task_By_User.php?id=<?php echo $row['Task_ID']; ?>"><span style="color: blue; font-size: 20px;" class="m-r-10 mdi mdi-grease-pencil"></span></a></td> 
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