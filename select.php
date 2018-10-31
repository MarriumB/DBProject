<?php  
 $connect = mysqli_connect("localhost", "marium", "13099", "CUSTOMERS");  
 $output = '';  
 $sql = "SELECT * FROM SALESORDER_13099 WHERE CUSTOMER='".$_POST["CUSTOMER_ID"]."' ORDER BY ORDER_NO";  
 $sql1 = "SELECT * FROM OURCLIENTS WHERE ID='".$_POST["CUSTOMER_ID"]."'";
 $sql2 = "SELECT SPID FROM SALESPERSONN_13099";
 $sql3 = "SELECT PRODUCTCODE FROM PRODUCT_13099";
 $result = mysqli_query($connect, $sql);  
 $result1 = mysqli_query($connect, $sql1);
 $result2 = mysqli_query($connect, $sql2);
 $row = mysqli_fetch_array($result1);
 $output .= '  
	<h3>Customer Info</h3>
	<table class="table table-bordered" style="background-color: #FF69B4;">
	 <tr>
	 <th style="padding: 20px;">ID</th>
	 <th style="padding: 20px;">Name</th>
	 <th style="padding: 20px;">Person</th>
	 <th style="padding: 20px;">Contact_No</th>
	 <th style="padding: 20px;">Address</th>
	 <th style="padding: 20px;">Email</th>
	 </tr>
	<tr>
	     <td style="padding: 20px;">'.$row["ID"].'</td>
	     <td style="padding: 20px;">'.$row["NAME"].'</td>
	     <td style="padding: 20px;">'.$row["CNAME"].'</td>
	     <td style="padding: 20px;">'.$row["PHONE"].'</td>
	     <td style="padding: 20px;">'.$row["ADDRESS"].'</td>
	     <td style="padding: 20px;">'.$row["EMAILID"].'</td>
	</tr>
	</table>
<h3>Invoice</h3>
      <div class="table-responsive">  
           <table class="table table-bordered" style="background-color: #FFC0CB;">  
                <tr>  
                     <th width="10%" style="padding: 20px;">Order No.</th>  
                     <th width="40%" style="padding: 20px;">Customer ID</th>  
                     <th width="40%" style="padding: 20px;">Date</th> 
                     <th width="40%" style="padding: 20px;">Salesperson ID</th>
                     <th width="40%" style="padding: 20px;">Product Code</th>
                     <th width="40%" style="padding: 20px;">Quantity</th>
                     <th width="40%" style="padding: 20px;">Rate</th>
                     <th width="40%" style="padding: 20px;">Amount</th> 
                     <th width="10%" style="padding: 20px;">Delete/Add</th>  
                </tr>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = mysqli_fetch_array($result))  
      {  
	   $result3 = mysqli_query($connect, $sql3);
	   $result2 = mysqli_query($connect, $sql2);
           $output .= '  
                <tr>  
                     <td class="ORDER_NO" data-id1="'.$row["ORDER_NO"].'" contenteditable>'.$row["ORDER_NO"].'</td>  
                     <td>'.$row["CUSTOMER"].'</td> 
                     <td class="DATE" data-id3="'.$row["ORDER_NO"].'" contenteditable>'.$row["DATE"].'</td>
                     <td>';
		     $output .= '<select class="SALESPERSON" data-id4="'.$row["ORDER_NO"].'">';
			$output .= '<option value="">None</option>';
    			while ($row1 = mysqli_fetch_array($result2)) { 
                  	$output .= '<option value="'.$row1["SPID"].'"'.($row["SALESPERSON"]==$row1["SPID"]?'selected="selected"':"").'>'.$row1["SPID"].'</option>';                
			}
    			$output .= '</select>
			</td>
                     	<td>';
		     	$output .= '<select class="PRODUCT" data-id5="'.$row["ORDER_NO"].'">';
			$output .= '<option value="">None</option>';
    			while ($row2 = mysqli_fetch_array($result3)) { 
                  	$output .= '<option value="'.$row2["PRODUCTCODE"].'"'.($row["PRODUCT"]==$row2["PRODUCTCODE"]?'selected="selected"':"").'>'.$row2["PRODUCTCODE"].'</option>';                
			}
    			$output .= '</select>
		     </td>
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
                <td id="CUSTOMER">'.$_POST["CUSTOMER_ID"].'</td>  
                <td id="DATE" contenteditable></td>  
                <td>';
		$output .= '<select id="SALESPERSON">';
		$output .= '<option value="">None</option>';
		$result2 = mysqli_query($connect, $sql2);
    		while ($row1 = mysqli_fetch_array($result2)) { 
                  $output .= '<option value="'.$row1["SPID"].'">'.$row1["SPID"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td>';
		$output .= '<select id="PRODUCT">';
		$output .= '<option value="">None</option>';
		$result3 = mysqli_query($connect, $sql3);
    		while ($row2 = mysqli_fetch_array($result3)) { 
                  $output .= '<option value="'.$row2["PRODUCTCODE"].'">'.$row2["PRODUCTCODE"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td id="QUANTITY" contenteditable></td>  
                <td> Auto </td>  
                <td> Auto </td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
		<tr>  
                <td id="ORDER_NO" contenteditable></td>  
                <td id="CUSTOMER">'.$_POST["CUSTOMER_ID"].'</td>  
                <td id="DATE" contenteditable></td>  
                <td>';
		$output .= '<select id="SALESPERSON">';
		$output .= '<option value="">None</option>';
		$result2 = mysqli_query($connect, $sql2);
    		while ($row1 = mysqli_fetch_array($result2)) { 
                  $output .= '<option value="'.$row1["SPID"].'">'.$row1["SPID"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td>';
		$output .= '<select id="PRODUCT">';
		$output .= '<option value="">None</option>';
		$result3 = mysqli_query($connect, $sql3);
    		while ($row2 = mysqli_fetch_array($result3)) { 
                  $output .= '<option value="'.$row2["PRODUCTCODE"].'">'.$row2["PRODUCTCODE"].'</option>';                
		}
    		$output .= '</select>
		</td>  
                <td id="QUANTITY" contenteditable></td>  
                <td> Auto </td>  
                <td> Auto </td>  
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
           </tr>
<tr>  
                          <td colspan="4">No Applicable Data</td>  
                     </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>
