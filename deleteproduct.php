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
try {
     
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $productcode=isset($_GET['productcode']) ? $_GET['productcode'] : die('ERROR: Record ID not found.');
 
    // delete query
    $query = "DELETE FROM PRODUCT_13099 WHERE PRODUCTCODE= ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $productcode);
     
    if($stmt->execute()){
        // redirect to read records page and 
        // tell the user record was deleted
        header('Location: producttable.php?action=deleted');
    }else{
        die('Unable to delete record.');
    }
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
