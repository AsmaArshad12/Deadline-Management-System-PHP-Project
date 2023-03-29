<?php
$conn = mysqli_connect("localhost", "root", "", "deadline_management_system");
          
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " 
        . mysqli_connect_error());
}
if(isset($_POST['submit']))
{
// Taking all 5 values from the form data(input)
$email =  $_POST['email'];
$password =  $_POST['password'];

$query="select * from login where Email='$email'and Password='$password'" ;
$result= mysqli_query($conn, $query);


if (mysqli_num_rows($result)>0) {
    $row= mysqli_fetch_array($result);

   $_SESSION['clientemail']=  $row['email'];
   $_SESSION['clientname'] = $row['name'];
     if($email=="sumairmalik184@gmail.com")
     {
     echo "<script>window.location='Admin/admin_dashboard.php';alert('Login Successfully');</script>";
     }
     else
     {
         echo "<script>window.location='';alert('Login Successfully');</script>";
     }
}
else
{
    echo "<script>window.location='index.php';alert('Invalid Email Or Password');</script>";
}
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
    <title>Login</title>    
       <link href="assets/css/login.css" rel="stylesheet">    
</head>

<body>
<div class="container" style="bottom:0px">
	<div class="screen">
		<div class="screen__content">
			<form method="post" action="" class="login" >
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					    <select name="user_type" class="login__input text-primary" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
				</div>

				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="email" name="email" class="login__input" placeholder="Email" required>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" class="login__input" placeholder="Password" required> 
				</div>
				<button type="submit" name="submit" class="button login__submit">
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>