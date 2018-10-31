<?php  
 $connect = mysqli_connect("localhost", "marium", "13099", "CUSTOMERS");  
 $output = '';  
 $sql = "SELECT * FROM SALESORDER_13099 ORDER BY ORDER_NO";  
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered" style="background-color: #FFC0CB;">     
                <tr>  
                     <th width="10%">Order Number</th>  
                     <th width="40%">Customer ID</th>  
                     <th width="40%">Date</th>  
                     <th width="40%">Salesperson ID</th>  
                     <th width="40%">Product Code</th>  
                     <th width="40%">Quantity</th>  
                     <th width="40%">Rate</th>  
                     <th width="40%">Amount</th>  
                     <th width="10%">Add/Delete</th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td class="ORDER_NO" data-id1="'.$row["ORDER_NO"].'" contenteditable>'.$row["ORDER_NO"].'</td>  
                     <td class="CUSTOMER" data-id2="'.$row["ORDER_NO"].'" contenteditable>'.$row["CUSTOMER"].'</td> 
                     <td class="DATE" data-id3="'.$row["ORDER_NO"].'" contenteditable>'.$row["DATE"].'</td>  
                     <td class="SALESPERSON" data-id4="'.$row["ORDER_NO"].'" contenteditable>'.$row["SALESPERSON"].'</td> 
                     <td class="PRODUCT" data-id5="'.$row["ORDER_NO"].'" contenteditable>'.$row["PRODUCT"].'</td>  
                     <td class="QUANTITY" data-id6="'.$row["ORDER_NO"].'" contenteditable>'.$row["QUANTITY"].'</td> 
                     <td class="RATE" data-id7="'.$row["ORDER_NO"].'" contenteditable>'.$row["RATE"].'</td>  
                     <td>'.$row["AMOUNT"].'</td>  
                     <td><button type="button" name="delete_btn" data-id9="'.$row["ORDER_NO"].'" class="btn btn-xs btn-danger btn_delete">X</button></td>  
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td id="ORDER_NO" contenteditable></td>  
                <td id="CUSTOMER" contenteditable></td>
                <td id="DATE" contenteditable></td>  
                <td id="SALESPERSON" contenteditable></td>
                <td id="PRODUCT" contenteditable></td>  
                <td id="QUANTITY" contenteditable></td>
                <td id="RATE" contenteditable></td>  
                <td></td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Data not Found</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>
