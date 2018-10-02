<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
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
    $query = "SELECT * FROM SALESPERSONN_13099 WHERE ID = ?";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $id);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $name = $row['NAME'];
    $contact = $row['CONTACT'];
    $id = $row['ID'];
    $spid=$row['SPID'];

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
        $query = "UPDATE SALESPERSONN_13099
                    SET NAME=:NAME, CONTACT=:CONTACT, ID=:ID ,SPID=:SPID
                    WHERE ID='$id'";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $name=htmlspecialchars(strip_tags($_POST['NAME']));
        $contact=htmlspecialchars(strip_tags($_POST['CONTACT']));
        $id=htmlspecialchars(strip_tags($_POST['ID']));
        $spid=htmlspecialchars(strip_tags($_POST['SPID']));
    
 
        // bind the parameters
        $stmt->bindParam(':NAME', $name);
        $stmt->bindParam(':CONTACT', $contact);
        $stmt->bindParam(':ID', $id);
        $stmt->bindParam(':SPID', $spid);


         
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
            <td>Contact</td>
            <td><input type='text' name='CONTACT' value="<?php echo htmlspecialchars($contact, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            
            <td>ID</td>
           <td> 
         <?php
	    //$stmt = $con->prepare("select ID from OURCLIENTS");
                   $stmt=$con->prepare("SELECT     a.ID
	FROM      OURCLIENTS a
	LEFT JOIN  SALESPERSONN_13099 b ON b.ID = a.ID
	WHERE      b.ID IS NULL");
	    $stmt->execute();
	    echo "<select name='ID'>";
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo '<option value="'.$row["ID"].'">'.$row["ID"].'</option>';
            }
	    echo "</select>";
	    ?></td>
        </tr>
	<tr>
     
<td>Spid</td>
            <td><input type='text' name='SPID' value="<?php echo htmlspecialchars($spid, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='mytablesalesperson.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
