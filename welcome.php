
<?php


$servername = "localhost";
$username = "marium";
$password = "13099";
$dbname = "CUSTOMERS";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$str1="Select count(*) from OURCLIENTS";

$str2="Select count(*) from PRODUCT_13099";

$str3="Select count(*) from SALESORDER_13099";

$str4="Select count(*) from SALESPERSONN_13099";

$str5="Select count(*) from USER_13099";

$result1= mysqli_fetch_array(mysqli_query($conn, $str1));
$result2= mysqli_fetch_array(mysqli_query($conn, $str2));
$result3= mysqli_fetch_array(mysqli_query($conn, $str3));
$result4= mysqli_fetch_array(mysqli_query($conn, $str4));
$result5= mysqli_fetch_array(mysqli_query($conn, $str5));

?>


<html>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
     <script src="https://cdn.anychart.com/js/8.0.1/anychart-core.min.js"></script>
      <script src="https://cdn.anychart.com/js/8.0.1/anychart-pie.min.js"></script>  
 <head>
      <title>Home Page</title>
   </head>
   
   <body>
      <h1 align="center">H O M E  P A G E<?php ?></h1>

   <div id="container" style="width: 100%; height: 100%"></div>

	<table>
	<tr>
	<div align="center" style="margin: 20px">
	<a href='mytable.php' class='btn btn-primary'>Customer</a>
	<a href='mytablesalesperson.php' class='btn btn-primary'>Salesperson</a>
	<a href='producttable.php' class='btn btn-primary'>Product</a>
       <a href='survey.php' class='btn btn-primary'>Survey</a>
        <a href='usertable.php' class='btn btn-primary'>User</a>
              <a href='salesorder.php' class='btn btn-primary'>Salesorder</a>
       
       
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	
	</div>
	</tr>
	<tr>
	<div align="center" style="margin: 20px">
	<a href = "logout.php" class="btn btn-danger">Sign Out</a>
	</div>
	</tr>
	</table> 
   </body>

<script type="text/javascript">
anychart.onDocumentReady(function() {

  // set the data
  var data = [
      {x: "Customers", value: <?php echo $result1[0]; ?>},
      {x: "Salesperson", value: <?php echo $result2[0]; ?>},
      {x: "Products", value: <?php echo $result3[0]; ?>},
      {x: "Users", value: <?php echo $result4[0]; ?>},
      {x: "Salesorders", value: <?php echo $result5[0]; ?>}
 
  ];

  // create the chart
  var chart = anychart.pie();

  // set the chart title
  chart.title("Dashboard");

  // add the data
  chart.data(data);

  // display the chart in the container
  chart.container('container');
  chart.draw();

});


</script>

</html>


