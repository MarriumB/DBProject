<?php  
 $connect = mysqli_connect("localhost", "marium", "13099", "CUSTOMERS");  
 $res = mysqli_query($connect, "SELECT SALESPRICE FROM PRODUCT_13099 WHERE PRODUCTCODE='".$_POST["PRODUCT"]."'");
 $row = mysqli_fetch_array($res);
 $sql = "INSERT INTO SALESORDER_13099 VALUES('".$_POST["ORDER_NO"]."', '".$_POST["CUSTOMER"]."', '".$_POST["DATE"]."', '".$_POST["SALESPERSON"]."', '".$_POST["PRODUCT"]."', '".$_POST["QUANTITY"]."', '".$row["SALESPRICE"]."', '".$_POST["AMOUNT"]."')";  
 if(mysqli_query($connect, $sql))  
 {  
      mysqli_query($connect, "UPDATE SALESORDER_13099 SET AMOUNT=RATE*QUANTITY WHERE ORDER_NO='".$_POST["ORDER_NO"]."'");
      echo 'Data Inserted';  
 }
 else{
      echo 'Error';
 } 
 ?> 
