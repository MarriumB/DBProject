<!DOCTYPE HTML>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <div class="container">
   
        <div class="page-header">
            <h1>Create a Salesperson</h1>
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
        $query = "INSERT INTO SALESPERSONN_13099 SET NAME=:NAME, CONTACT=:CONTACT, ID=:ID , SPID=:SPID";
 
        // prepare query for execution
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
            echo "<div class='alert alert-success'>Record was saved.</div>";
	    header("refresh:1;url=mytablesalesperson.php");


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
            <td>CONTACT</td>
            <td><input type='text' name='CONTACT' class='form-control' /></td>
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
	    ?>
            </td>
        </tr>
	<tr>
             <td>SPID</td>
            <td><input type= 'text' name='SPID' class='form-control' /></td>
             </tr>

            <td></td>
            <td>
                <input type='submit' value='Save' class='btn btn-primary'></input>
              <a href='mytablesalesperson.php' class='btn btn-danger'>Back</a>
            </td>
        </tr>
   


    </table>
</form>






    </div> 
      


  
</body>
</html>
