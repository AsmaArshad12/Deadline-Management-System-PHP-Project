<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>View User</title>
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