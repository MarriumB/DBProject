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
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $username=isset($_GET['username']) ? $_GET['username'] : die('ERROR: Record ID not found.');
 
    // delete query
    $query = "DELETE FROM USER_13099 WHERE USERNAME= ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $username);
     
    if($stmt->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: usertable.php?action=deleted1');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
