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
<?php 
       include 'admin_sidebar.php'
       ?>
<head>
    <title>Tasks</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/Flexy-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- Custom CSS -->
    <link href="../assets/css/style.min.css" rel="stylesheet">
    <link href="../assets/css/model.css" rel="stylesheet">
    
</head>

<body>
    
    <!--<div class="preloader">
      <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>-->
    

    <div id="main-wrapper">     
    
        <div class="page-wrapper">
            <div class="page-breadcrumb" style="margin-bottom: 0px; padding-bottom: 5px; padding-top: 15px;">
                <div class="row align-items-center">
                    <div class="col-6">
                        
                        <h2 class="mb-0 fw-bold">All Tasks</h2> 
                    </div>
                    <div class="col-6">
                        
                    </div>
                </div>
            </div>

            <form method="post"  style="font-size: 13px;">
                <div class="container-fluid">
                 <div class="row mb-4" style="padding-left: 14px; padding-right: 14px;">
                         <div class="col-lg-2">
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

                        <div class="col-lg-1">
                            <input type="submit" name="submit" value="Search" class="btn btn-primary">
                        </div>

                        <div class="col-lg-3" style="text-align: right;">
                            <a href="Add_Task.php" class="btn btn-primary">Add Task</a>
                        </div>
                 </div>

                <span class="text-danger h5"><?php if(isset($search_error)) {echo $search_error;} ?>
                </span>

                    <div class="col-lg-12 mb-6 mt-6" > 
                            <div class="table-responsive" style="margin-left:400px;">
                                <table class="table table-striped">
                                    <tr> 
                                        <th>Action&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Status&nbsp;Trigger</th>
                                        <th>Status</th>
                                        <th>Team&nbsp;Lead</th>
                                        <th>Team&nbsp;Lead&nbsp;Status</th>
                                        <th>Actual&nbsp;Deadline</th>
                                        <th>Start&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Due&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                        <th>Assigned</th>  
                                        <th>Code</th>
                                        <th>Title</th> 
                                        <th>Client&nbsp;Name</th>
                                        <th>Payment&nbsp;Status</th>   
                                        <th>Price</th>
                                        <th>Recieved&nbsp;Price</th>
                                        <th>Remaining&nbsp;Price</th>
                                        <th>Account&nbsp;Type</th>                                        
                                        <th>Course&nbsp;Name</th>
                                        <th>Module</th>         
                                        <th>Grades</th>                               
                                        <th>Comments</th>                                                                              
                                        <th>Current&nbsp;Time</th>                                                                                                                                
                                    </tr>                                                     
        <?php
        while($row= mysqli_fetch_array($search_result))
        {
        ?>        
            <tr>
               <td><a  role="button" href="Update_Task_By_Admin.php?id=<?php echo $row['Task_ID']; ?>"><span style="color: blue; font-size: 15px;" class="m-r-10 mdi mdi-grease-pencil"></span></a>&nbsp;&nbsp;<a role="button" href="Delete_Task.php?id=<?php echo $row['Task_ID'];?>" onclick="javascript:return confirm('Are You Confirm Deletion');" ><span style="color: red; font-size: 15px;"  class="m-r-10 mdi mdi-delete-sweep"></span></a></td>
                
               <!-- <td><a  role="button" href="Update_Task_By_Admin.php?id=<?php echo $row['Task_ID']; ?>"><span style="color: blue; font-size: 15px;" class="m-r-10 mdi mdi-grease-pencil"></span></a>&nbsp;&nbsp;<a role="button" href="Delete_Task.php?id=<?php echo $row['Task_ID']; ?>"><span style="color: red; font-size: 15px;" class="m-r-10 mdi mdi-delete-sweep"></span></a></td> -->
                <td><?php echo $row['Status_Trigger']; ?></td>
                <td>
                  <?php
                  if(($row['Time'] > $row['Due_Date']) && ($row['Status'] != 'Submitted') && ($row['Status'] != 'Done') && ($row['Status'] != 'Updated') && ($row['Status'] != 'Edit'))
                  {?>
                    <label class="badge" style="background-color: #0000FF;"><?php echo "Past Due Danger" ?></label>
                  <?php
                  }
                  elseif(($row['Time'] == $row['Due_Date']) && ($row['Status'] != 'Submitted') && ($row['Status'] != 'Done') && ($row['Status'] != 'Updated') && ($row['Status'] != 'Edit'))
                  {?>
                    <label class="badge bg-danger"><?php echo "Highly Sensitive" ?></label>
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
                <td>
                  <?php
                  if($row['Actual_Deadline'] != '0000-00-00')
                  {
                    echo $row['Actual_Deadline'];
                  }                   
                  ?>
                </td>
                <td><?php echo $row['Start_Date']; ?></td>
                <td>
                <?php
                  if($row['Due_Date'] != '0000-00-00')
                  {
                    echo $row['Due_Date'];
                  }                   
                  ?>                 
                </td>
                <td><?php echo $row['Assigned']; ?></td>
                <td><?php echo $row['Code']; ?></td> 
                <td><?php echo $row['Title']; ?></td>
                <td><?php echo $row['Client_Name']; ?></td>
                <td><?php echo $row['Payment_Status']; ?></td>
                <td><?php echo $row['Price']; ?></td>
                <td>
                  <?php echo $row['Recieved_Price']; ?>
                </td>
                <td><?php echo $row['Remaining_Price']; ?></td>
                <td><?php echo $row['Account_Type']; ?></td>                
                <td><?php echo $row['Course_Name']; ?></td>
                <td><?php echo $row['Module']; ?></td>  
                <td><?php echo $row['Grades']; ?></td>              
                <td><?php echo $row['Comments']; ?></td>
                <td><?php echo $row['Time']; ?></td>

               <!-- <td><a  role="button" href="Update_Task_By_Admin.php?id=<?php echo $row['Task_ID']; ?>"><span style="color: blue; font-size: 20px;" class="m-r-10 mdi mdi-grease-pencil"></span></a></td>
                <td><a  role="button" href="Delete_Task.php?id=<?php echo $row['Task_ID']; ?>"><span style="color: red; font-size: 20px;" class="m-r-10 mdi mdi-delete-sweep"></span></a></td>
                -->
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



<script type="text/javascript">

function showDiv(select){
   if(select.value=="Paid"){
    document.getElementById('price').style.display = "block";
   } else{
    document.getElementById('price').style.display = "none";
   }
} 

</script>