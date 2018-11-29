<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <!-- container -->
    <div class="container">
  
        <div class="page-header">
            <h1>Update User</h1>
        </div>
     
<?php
$host = "localhost";
$db_name = "CUSTOMERS";
$db_username = "marium";
$db_password = "13099";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $db_username, $db_password);
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

$username=isset($_GET['username']) ? $_GET['username'] : die('ERROR: Record ID not found.');
  
// read current record's data
try {
    // prepare select query
    $query = "SELECT * FROM USER_13099 WHERE USERNAME = ?";
    $stmt = $con->prepare( $query );
     
    // this is the first question mark
    $stmt->bindParam(1, $username);
     
    // execute our query
    $stmt->execute();
     
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
    // values to fill up our form
    $password = $row['PASSWORD'];
    $spid = $row['SPID'];

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
        $query = "UPDATE USER_13099
                    SET USERNAME=:USERNAME, PASSWORD=:PASSWORD, SPID=:SPID
                    WHERE USERNAME='$username'";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $username=htmlspecialchars(strip_tags($_POST['USERNAME']));
        $password=htmlspecialchars(strip_tags($_POST['PASSWORD']));
        $spid=htmlspecialchars(strip_tags($_POST['SPID']));
    
 
        // bind the parameters
        $stmt->bindParam(':USERNAME', $username);
        $stmt->bindParam(':PASSWORD', $password);
        $stmt->bindParam(':SPID', $spid);


         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated.</div>";
	    header("Refresh: 1, url=usertable.php");
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?username={$username}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>UserName</td>
            <td><input type='text' name='USERNAME' value="<?php echo htmlspecialchars($username, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='text' name='PASSWORD' value="<?php echo htmlspecialchars($password, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
	<tr>
            
            <td>ID</td>
           <td> 
         <?php
	    //$stmt = $con->prepare("select ID from OURCLIENTS");
                   $stmt=$con->prepare("SELECT     a.SPID
	FROM      SALESPERSONN_13099 a
	LEFT JOIN  USER_13099 b ON b.SPID = a.SPID
	WHERE      b.SPID IS NULL");
	    $stmt->execute();
	    echo "<select name='SPID'>";
	    echo '<option value="">None</option>';
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo '<option value="'.$row["SPID"].'">'.$row["SPID"].'</option>';
            }
	    echo "</select>";
	    ?></td>
        </tr>
	<tr>
            
            <td></td>
            <td>
                <input type='submit' value='Save Changes' class='btn btn-primary' />
                <a href='usertable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> <!-- end .container -->
     
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</body>
</html>
