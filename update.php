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
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
  
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM OURCLIENTS WHERE ID = ?";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $name = $row['NAME'];
    $cname = $row['CNAME'];
    $phone = $row['PHONE'];
    $emailid=$row['EMAILID'];
    $id=$row['ID'];
    $address=$row['ADDRESS'];
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
        $query = "UPDATE OURCLIENTS 
                    SET NAME=:NAME, CNAME=:CNAME, PHONE=:PHONE, EMAILID=:EMAILID, ADDRESS=:ADDRESS 
                    WHERE ID=:id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['NAME']));
        $cname=htmlspecialchars(strip_tags($_POST['CNAME']));
        $phone=htmlspecialchars(strip_tags($_POST['PHONE']));
        $emailid=htmlspecialchars(strip_tags($_POST['EMAILID']));
        $address=htmlspecialchars(strip_tags($_POST['ADDRESS']));
 
        // bind the parameters
        $stmt->bindParam(':NAME', $name);
        $stmt->bindParam(':CNAME', $cname);
        $stmt->bindParam(':PHONE', $phone);
        $stmt->bindParam(':EMAILID', $emailid);
        $stmt->bindParam(':ADDRESS', $address);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='NAME' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Cname</td>
            <td><input type='text' name='CNAME' value="<?php echo htmlspecialchars($cname, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Phone</td>
            <td><input type='text' name='PHONE' value="<?php echo htmlspecialchars($phone, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>Emailid</td>
            <td><input type='text' name='EMAILID' value="<?php echo htmlspecialchars($emailid, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>id</td>
            <td><input type='text' name='ID' value="<?php echo htmlspecialchars($id, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            <td>address</td>
            <td><input type='text' name='ADDRESS' value="<?php echo htmlspecialchars($address, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='mytable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
