<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
  
    
    <div class="container">
   
        <div class="page-header">
            <h1>Create Product</h1>
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
        $query = "INSERT INTO PRODUCT_13099 SET PRODUCTCODE=:PRODUCTCODE, BRAND=:BRAND, TYPE=:TYPE, SHADE=:SHADE, SALESPRICE=:SALESPRICE";
 
        // prepare query for execution
        $stmt = $con->prepare($query);
 
     
 
        // posted values
        $product=htmlspecialchars(strip_tags($_POST['PRODUCTCODE']));
        $brand=htmlspecialchars(strip_tags($_POST['BRAND']));
        $type=htmlspecialchars(strip_tags($_POST['TYPE']));
        $shade=htmlspecialchars(strip_tags($_POST['SHADE']));
        $salesprice=htmlspecialchars(strip_tags($_POST['SALESPRICE']));
   

 
        // bind the parameters
        $stmt->bindParam(':PRODUCTCODE', $product);
        $stmt->bindParam(':BRAND', $brand);
        $stmt->bindParam(':TYPE', $type);
        $stmt->bindParam(':SHADE', $shade);
        $stmt->bindParam(':SALESPRICE', $salesprice);
        


         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was saved.</div>";
	    header("refresh:1;url=producttable.php");
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
            <td>PRODUCTCODE</td>
            <td><input type='text' name='PRODUCTCODE' class='form-control' /></td>
        </tr>
	<tr>
            <td>BRAND</td>
            <td><input type='text' name='BRAND' class='form-control' /></td>
        </tr>
	<tr>
            <td>TYPE</td>
            <td><input type='text' name='TYPE' class='form-control' /></td>
        </tr>
	<tr>
            <td>SHADE</td>
            <td><input type='text' name='SHADE' class='form-control' /></td>
        </tr>
	<tr>
            <td>SALESPRICE</td>
            <td><input type='text' name='SALESPRICE' class='form-control' /></td>
        </tr>
	<tr>
         <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary' />
              <a href='producttable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>





    </div> 
      


  
</body>
</html>



