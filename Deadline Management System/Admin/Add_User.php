<?php

include '../dbconnection.php';

if (isset($_POST['submit']))
 {
   $name= $_POST['name'];
   $email= $_POST['email'];
   $hash = password_hash($plaintext_password, 
          PASSWORD_DEFAULT);

    $query = "insert into user(UserName, Email, Password) VALUES('$name','$email','$password')";
    $result= mysqli_query($con, $query);

    if($result)
    {
      echo "<script>window.location='View_User.php';alert('User Added Successfully');</script>";
    }
    else 
    {
      echo "<script>window.location='Add_User.php';alert('Invalid Data');</script>";
    }
    
 }
 ?>

?>

<!DOCTYPE html>
<html>

<head>
   <title>Add User</title>
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
      ?>
  
     
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Add User</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Add User</h1> 
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
                                <form class="form-horizontal form-material mx-2">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" name="name" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" class="form-control form-control-line" name="email"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" value="password" class="form-control form-control-line">
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="submit" class="btn btn-success text-white">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
  </body>
</html>