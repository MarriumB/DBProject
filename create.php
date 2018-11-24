<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
  
    
    <div class="container">
   
        <div class="page-header">
            <h1>Create a Customer</h1>
        </div>
      
<?php

// used to connect to the database
$host = "localhost";
$db_name = "CUSTOMERS";
$username = "marium";
$password = "13099";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

if($_POST){
 



 
    try{
         // insert query
        $query = "INSERT INTO OURCLIENTS SET NAME=:NAME, CNAME=:CNAME, PHONE=:PHONE, EMAILID=:EMAILID,ID=:ID,ADDRESS=:ADDRESS";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
     
 
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['NAME']));
        $cname=htmlspecialchars(strip_tags($_POST['CNAME']));
        $phone=htmlspecialchars(strip_tags($_POST['PHONE']));
        $emailid=htmlspecialchars(strip_tags($_POST['EMAILID']));
        $id=htmlspecialchars(strip_tags($_POST['ID']));
        $address=htmlspecialchars(strip_tags($_POST['ADDRESS']));

 
        // bind the parameters
        $stmt->bindParam(':NAME', $name);
        $stmt->bindParam(':CNAME', $cname);
        $stmt->bindParam(':PHONE', $phone);
        $stmt->bindParam(':EMAILID', $emailid);
        $stmt->bindParam(':ID', $id);
        $stmt->bindParam(':ADDRESS', $address);
       


         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
	    header("refresh:1;url=mytable.php");
        }else{
            echo "<div class='alert alert-danger'>Unable to save record.</div>";
        }
         
    }
     
    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>   
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>NAME</td>
            <td><input type='text' name='NAME' class='form-control' /></td>
        </tr>
	<tr>
            <td>CNAME</td>
            <td><input type='text' name='CNAME' class='form-control' /></td>
        </tr>
	<tr>
            <td>PHONE</td>
            <td><input type='text' name='PHONE' class='form-control' /></td>
        </tr>
	<tr>
            <td>EMAILID</td>
            <td><input type='text' name='EMAILID' class='form-control' /></td>
        </tr>
	<tr>
            <td>ID</td>
            <td><input type='text' name='ID' class='form-control' /></td>
        </tr>
	<tr>
            <td>ADDRESS</td>
            <td><input type='text' name='ADDRESS' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
              <a href='mytable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>





    </div> 
      


  
</body>
</html>



