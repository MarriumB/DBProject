<!DOCTYPE HTML>
<html>

<body>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <div class="container">
   
        <div class="page-header">
            <h1>Create User</h1>
        </div>


      
<?php

// used to connect to the database
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

if($_POST){
 



 
    try{
         // insert query
        $query = "INSERT INTO USER_13099 SET USERNAME=:USERNAME, PASSWORD=:PASSWORD, SPID=:SPID";
 
        // prepare query for execution
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
            echo "<div class='alert alert-success'>Record was saved.</div>";
	    header("Refresh: 1, url=usertable.php");



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
            <td>USERNAME</td>
            <td><input type='text' name='USERNAME' class='form-control' /></td>
        </tr>
	<tr>
            <td>PASSWORD</td>
            <td><input type='text' name='PASSWORD' class='form-control' /></td>
        </tr>
	<tr>
             <td>SPID</td>
             <td><?php
	    //$stmt = $con->prepare("select ID from OURCLIENTS");
                   $stmt=$con->prepare("SELECT     a.SPID
	FROM      SALESPERSONN_13099 a
	LEFT JOIN  USER_13099 b ON b.SPID = a.SPID
	WHERE      b.SPID IS NULL");
	    $stmt->execute();
	    echo "<select name='SPID'>";
	echo '<option value="">none</option>';
	    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		echo '<option value="'.$row["SPID"].'">'.$row["SPID"].'</option>';
            }
	    echo "</select>";
	    ?></td>
             </tr>
	    <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary'></input>
              <a href='usertable.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
   


    </table>
</form>






    </div> 
      


  
</body>
</html>
