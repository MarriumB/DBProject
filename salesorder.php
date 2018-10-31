<html>  
      <head>  
           <title>Salesorder</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      </head>  
      <body>  
           <div class="container">  

                <br />  
                <div class="table-responsive">  
                     <h3 align="center">Invoice Table</h3><br />  
                     <div id="live_data"></div>                 
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      function fetch_data()  
      {  
           $.ajax({  
                url:"select.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
      fetch_data();  
      $(document).on('click', '#btn_add', function(){  
           var ORDER_NO = $('#ORDER_NO').text();  
           var CUSTOMER = $('#CUSTOMER').text();  
           var DATE = $('#DATE').text();  
           var SALESPERSON = $('#SALESPERSON').text();  
           var PRODUCT = $('#PRODUCT').text();  
           var QUANTITY1 = $('#QUANTITY').text();  
           var RATE1 = $('#RATE').text(); 
 	   var QUANTITY = parseInt(QUANTITY1);  
           var RATE =parseInt(RATE1); 
           var AMOUNT =QUANTITY*RATE;
           if(ORDER_NO == '')  
           {  
                alert("Enter Order Number");  
                return false;  
           }  
           if(CUSTOMER == '')  
           {  
                alert("Enter Customer Id");  
                return false;  
           }  
           if(DATE == '')  
           {  
                alert("Enter Date");  
                return false;  
           }  
           if(SALESPERSON == '')  
           {  
                alert("Enter Salesperson Id");  
                return false;  
           }
           if(PRODUCT == '')  
           {  
                alert("Enter Product Code");  
                return false;  
           }  
           if(QUANTITY == '')  
           {  
                alert("Enter Quantity");  
                return false;  
           }
           if(RATE == '')  
           {  
                alert("Enter Rate");  
                return false;  
           }  
           $.ajax({  
                url:"insert.php",  
                method:"POST",  
                data:{ORDER_NO:ORDER_NO, CUSTOMER:CUSTOMER, DATE:DATE, SALESPERSON:SALESPERSON, PRODUCT:PRODUCT, QUANTITY:QUANTITY, RATE:RATE, AMOUNT:AMOUNT},  
                dataType:"text",  
                success:function(data)  
                {  
                     alert(data);  
                     fetch_data();  
                }  
           })  
      });  
      function edit_data(id, text, column_name)  
      {  
           $.ajax({  
                url:"edit.php",  
                method:"POST",  
                data:{id:id, text:text, column_name:column_name},  
                dataType:"text",  
                success:function(data){  
                     alert(data);  
                }  
           });  
      }  
      $(document).on('blur', '.ORDER_NO', function(){  
           var id = $(this).data("id1");  
           var ORDER_NO = $(this).text();  
           edit_data(id, ORDER_NO, "ORDER_NO");  
      });  
      $(document).on('blur', '.CUSTOMER', function(){  
           var id = $(this).data("id2");  
           var CUSTOMER = $(this).text();  
           edit_data(id,CUSTOMER, "CUSTOMER");  
      });
      $(document).on('blur', '.DATE', function(){  
           var id = $(this).data("id3");  
           var DATE = $(this).text();  
           edit_data(id, DATE, "DATE");  
      });  
      $(document).on('blur', '.SALESPERSON', function(){  
           var id = $(this).data("id4");  
           var SALESPERSON = $(this).text();  
           edit_data(id,SALESPERSON, "SALESPERSON");  
      });
      $(document).on('blur', '.PRODUCT', function(){  
           var id = $(this).data("id5");  
           var PRODUCT = $(this).text();  
           edit_data(id, PRODUCT, "PRODUCT");  
      });  
      $(document).on('blur', '.QUANTITY', function(){  
           var id = $(this).data("id6");  
           var QUANTITY = $(this).text();  
           edit_data(id,QUANTITY, "QUANTITY");  
      });
      $(document).on('blur', '.RATE', function(){  
           var id = $(this).data("id7");  
           var RATE = $(this).text();  
           edit_data(id, RATE, "RATE");  
      });   
      $(document).on('click', '.btn_delete', function(){  
           var id=$(this).data("id9");  
           if(confirm("Are you sure you want to delete this?"))  
           {  
                $.ajax({  
                     url:"del.php",  
                     method:"POST",  
                     data:{id:id},  
                     dataType:"text",  
                     success:function(data){  
                          alert(data);  
                          fetch_data();  
                     }  
                });  
           }  
      });  
 });  
 </script>
