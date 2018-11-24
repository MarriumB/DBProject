<!DOCTYPE HTML>
<html>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> 
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update Product</h1>
        </div>
     
<?php
$host = "localhost";
$db_name = "CUSTOMERS";
$username = "marium";
$password = "13099";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);

//HI
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

$productcode=isset($_GET['productcode']) ? $_GET['productcode'] : die('ERROR: Record ID not found.');
  
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM PRODUCT_13099 WHERE PRODUCTCODE = ?";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $productcode);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $productcode = $row['PRODUCTCODE'];
    $brand = $row['BRAND'];
    $type = $row['TYPE'];
    $shade=$row['SHADE'];
    $salesprice=$row['SALESPRICE'];
 
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
<?php
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE PRODUCT_13099 
                    SET PRODUCTCODE=:PRODUCTCODE, BRAND=:BRAND, TYPE=:TYPE, SHADE=:SHADE, SALESPRICE=:SALESPRICE 
                    WHERE PRODUCTCODE=:PRODUCTCODE";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $productcode=htmlspecialchars(strip_tags($_POST['PRODUCTCODE']));
        $brand=htmlspecialchars(strip_tags($_POST['BRAND']));
        $type=htmlspecialchars(strip_tags($_POST['TYPE']));
        $shade=htmlspecialchars(strip_tags($_POST['SHADE']));
        $salesprice=htmlspecialchars(strip_tags($_POST['SALESPRICE']));
 
        // bind the parameters
        $stmt->bindParam(':PRODUCTCODE', $productcode);
        $stmt->bindParam(':BRAND', $brand);
        $stmt->bindParam(':TYPE', $type);
        $stmt->bindParam(':SHADE', $shade);
        $stmt->bindParam(':SALESPRICE', $salesprice);

         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
	    header("refresh:1;url=producttable.php");
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
 
<!--we have our html form here where new record information can be updated-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?productcode={$productcode}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Productcode</td>
            <td><input type='text' name='PRODUCTCODE' value="<?php echo htmlspecialchars($productcode, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Brand</td>
            <td><input type='text' name='BRAND' value="<?php echo htmlspecialchars($brand, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Type</td>
            <td><input type='text' name='TYPE' value="<?php echo htmlspecialchars($type, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Shade</td>
            <td><input type='text' name='SHADE' value="<?php echo htmlspecialchars($shade, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Salesprice</td>
            <td><input type='text' name='SALESPRICE' value="<?php echo htmlspecialchars($salesprice, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='producttable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
