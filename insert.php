<?php  
 $connect = mysqli_connect("localhost", "marium", "13099", "CUSTOMERS");  
 $sql = "INSERT INTO SALESORDER_13099 VALUES('".$_POST["ORDER_NO"]."', '".$_POST["CUSTOMER"]."', '".$_POST["DATE"]."', '".$_POST["SALESPERSON"]."', '".$_POST["PRODUCT"]."', '".$_POST["QUANTITY"]."', '".$_POST["RATE"]."', '".$_POST["AMOUNT"]."')";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Inserted';  
 }  
 ?>
