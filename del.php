<?php  
 $connect = mysqli_connect("localhost", "marium", "13099", "CUSTOMERS");  
 $sql = "DELETE FROM SALESORDER_13099 WHERE ORDER_NO = '".$_POST["id"]."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Deleted';  
 }  
 ?>
