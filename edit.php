<?php  
 $connect = mysqli_connect("localhost", "marium", "13099", "CUSTOMERS");  
 $id = $_POST["id"];  
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE SALESORDER_13099 SET ".$column_name."='".$text."' WHERE ORDER_NO='".$id."'"; 
 if($column_name=='PRODUCT'){
	$res = mysqli_query($connect, "SELECT SALESPRICE FROM PRODUCT_13099 WHERE PRODUCTCODE='".$text."'");
	$row = mysqli_fetch_array($res);
	mysqli_query($connect, "UPDATE SALESORDER_13099 SET RATE='".$row['SALESPRICE']."' WHERE ORDER_NO='".$id."'");
 } 
 if(mysqli_query($connect, $sql))  
 {  
      mysqli_query($connect, "UPDATE SALESORDER_13099 SET AMOUNT=RATE*QUANTITY WHERE ORDER_NO='".$id."'");
      echo 'Data Updated';  
 }  
 ?>
