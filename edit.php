<?php  
 $connect = mysqli_connect("localhost", "marium", "13099", "CUSTOMERS");  
 $id = $_POST["id"];  
 $text = $_POST["text"];  
 $column_name = $_POST["column_name"];  
 $sql = "UPDATE SALESORDER_13099 SET ".$column_name."='".$text."' WHERE ORDER_NO='".$id."'";  
 if(mysqli_query($connect, $sql))  
 {  
      echo 'Data Updated';  
 }  
 ?>
