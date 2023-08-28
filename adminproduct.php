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
    <style>
    label {
  color: #B4886B;
  font-weight: bold;
  width: 130px;
  float:middle;
   }
   .button-74 {
  background-color: #fbeee0;
  border: 2px solid #422800;
  border-radius: 30px;
  box-shadow: #422800 4px 4px 0 0;
  color: #422800;
  cursor: pointer;
  display: inline-block;
  font-weight: 600;
  font-size: 18px;
  padding: 0 18px;
  line-height: 50px;
  text-align: center;
  text-decoration: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-74:hover {
  background-color: #fff;
}

.button-74:active {
  box-shadow: #422800 2px 2px 0 0;
  transform: translate(2px, 2px);
}

@media (min-width: 768px) {
  .button-74 {
    min-width: 120px;
    padding: 0 25px;
  }
}
</style>
</head>
<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        <!-- ============================================== TOP MENU ============================================== -->
        <?php include('includes/top-header.php');?>
        <!-- ============================================== TOP MENU : END ============================================== -->
        <?php include('includes/main-header.php');?>
            <!-- ============================================== NAVBAR ============================================== -->
        
        <!-- ============================================== NAVBAR : END ============================================== -->
    </header>
    <!-- ============================================== HEADER : END ============================================== -->
    
    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="sign-in-page inner-bottom-sm">
                <div class="row">
                <center>
        <h1>Add the product</h1>
        <form action="adminproduct.php" method="post">
            <!-- Customer Details -->
            <label for="id">ID:</label>
            <input type="text" name="id" required><br>
            
            <label for="category">Category:</label>
            <input type="text" name="category" required><br>

            <label for="subCategory">sub Category:</label>
            <input type="text" name=" subCategory" required><br>
            
            <!-- Product Information -->
            <label for="productName">Product Name:</label>
            <input type="text" name="productName" required><br>

            <label for="productCompany"> product Company:</label>
            <input type="text" name="productCompany" required><br>
            
            <label for="productPrice">Product Price:</label>
            <input type="number" name="productPrice"  required><br>

            <label for="productPriceBeforeDiscount">product Price Before Discount:</label>
            <input type="number" name="productPriceBeforeDiscount" step="0.01" required><br>
            
            <label for="productDescription">Product Description:</label>
            <textarea name="productDescription" required></textarea><br>

            <label for="productImage1"> product Image1:</label>
            <input type="text" name="productImage1" required><br>

            <label for="productImage2"> product Image2:</label>
            <input type="text" name="productImage2" required><br>

            <label for="productImage3"> product Image3:</label>
            <input type="text" name="productImage3" required><br>
            
            <label for="shippingCharge">Shipping Charge:</label>
            <input type="number" name="shippingCharge" step="0.01" required><br>
            
            <label for="productAvailability">Product Availability:</label>
            <input type="text" name="productAvailability" required><br>
            
            <label for="postingDate">Posting date:</label>
            <input type="text" name="postingDate" required><br>
            
            <label for="updationDate">Updation Date:</label>
            <input type="date" name="updationDate" required><br>
            <BR>
            <button class="button-74" role="button" >SUBMIT</button></a>
        </form>
        </center>
        </div>
        <!-- /.row -->
    </div>
<?php include('includes/brands-slider.php');?>
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