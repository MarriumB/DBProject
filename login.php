<?php
   ob_start();
   session_start();
?>

<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
   <head>
      <title>LOGIN.php</title>
      <link href = "css/bootstrap.min.css" rel = "stylesheet">
      
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #cae7ec;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 30px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#000000;
         }
         
         .form-signin input[type="password"] {
		 margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#000000;            
	
	}
         
         h2{
            text-align: center;
            color: #000000;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2>Enter Username and Password</h2> 
      <div class = "container form-signin">
         
         <?php
            $msg = '';
            
$servername = "localhost";
$username = "marium";
$password = "13099";
$dbname = "CUSTOMERS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {


	$a=$_POST['username'];
	$b=$_POST['password'];

		

	$USERq=mysqli_query($conn,"SELECT * FROM USER_13099 WHERE USERNAME='$a' AND PASSWORD='$b' ");
	$upQ = $USERq->fetch_assoc();
	$iD= $upQ['USERNAME'];
	$pS= $upQ['PASSWORD'];
		
	


		
               if ($_POST['username'] == $iD && 
                  $_POST['password'] == $pS) {
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $iD;
                  


                  //echo 'You have entered valid use name and password';)

                  header('Location: welcome.php');
               }else {
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username " 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password " required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
			
    
         
      </div> 
      
   </body>
</html>
