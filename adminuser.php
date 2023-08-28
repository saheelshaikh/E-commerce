<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    // Code for User login
    if(isset($_POST['login']))
    {
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
        $num=mysqli_fetch_array($query);
        if($num>0)
        {
            $extra="adminpanel.php";
            $_SESSION['login']=$_POST['email'];
            $_SESSION['id']=$num['id'];
            $_SESSION['username']=$num['name'];
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=1;
            $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            exit();
        }
        else
        {
            $extra="adminpanel.php";
            $email=$_POST['email'];
            $uip=$_SERVER['REMOTE_ADDR'];
            $status=0;
            $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']="Invalid Email Id or Password";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>Shopping Portal | Signi-in | Signup</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Customizable CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <!-- Demo Purpose Only. Should be removed in production -->
    <link rel="stylesheet" href="assets/css/config.css">

    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
    <!-- Demo Purpose Only. Should be removed in production : END -->

    
    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts --> 
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script type="text/javascript">
        function valid()
        {
            if(document.register.password.value!= document.register.confirmpassword.value)
            {
                alert("Password and Confirm Password Field do not match  !!");
                document.register.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function userAvailability()
        {
            $("#loaderIcon").show();
            jQuery.ajax({
            url: "check_availability.php",
            data:'email='+$("#email").val(),
            type: "POST",
            success:function(data)
            {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error:function (){}
            });
        }
    </script>
</head>
<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        <!-- ============================================== TOP MENU ============================================== -->
        <?php include('includes/top-header.php');?>
        <!-- ============================================== TOP MENU : END ============================================== -->
        <?php include('includes/main-header.php');?>
            <!-- ============================================== NAVBAR ============================================== -->
        <?php include('includes/menu-bar.php');?>
        <!-- ============================================== NAVBAR : END ============================================== -->
    </header>
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
    
<?php

error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping";

$conn = mysqli_connect("localhost","root","","shopping");
if (!$conn){
    die("Connection failed: " .$conn->connect_error);
}else{
    //echo "connection ok";
}

include("coonect.php");

    $query = "SELECT * FROM users";
    $data = mysqli_query($conn,$query);

    $total = mysqli_num_rows($data);

if($total != 0)
{
    ?>
     
    <h1 align="center"><mark><u>User Details</u></mark></h1>
    <table border="4" width="auto" align="center">
        <tr>
        <th width="3%">Id</th>
        <th width="5%">Name</th>
        <th width="15%">Email</th>
        <th width="15%">Contact no.</th>
       
        </tr>
    
    <?php
    while($result = mysqli_fetch_assoc($data))
    {
        echo "<tr>
                <td>".$result['id']."</td>
                <td>".$result['name']."</td>
                <td>".$result['email']."</td>
                <td>".$result['contactno']."</td>
                
               
            </tr> ";
    }
}
else{
    echo "No records found";
}
?>
</table>

<html>
    <head>
        <title>User Data</title>
        <style>
            
            table{
                background:white;
            }
            table th{
                border: 2px solid black;
            }
           
        </style>
    </head> 
</html> 

    </div>

<?php include('includes/footer.php');?>
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
	<script src="assets/js/owl.carousel.min.js"></script>
	
	<script src="assets/js/echo.min.js"></script>
	<script src="assets/js/jquery.easing-1.3.min.js"></script>
	<script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/scripts.js"></script>

	<!-- For demo purposes – can be removed on production -->
	
	<script src="switchstylesheet/switchstylesheet.js"></script>
	
	<script>
		$(document).ready(function()
        { 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function()
            {
				$(this).parent().toggleClass('open');
				return false;
			});
		});
		$(window).bind("load", function() 
        {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->
</body>
</html>