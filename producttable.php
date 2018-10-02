<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
echo "<div align='right'>";
echo "<a href='createproduct.php' class='btn btn-primary m-r-1em'>Create</a>";
echo "<a href='welcome.php' class='btn btn-primary m-r-1em'>Home</a>";
echo "<a href = 'logout.php' class='btn btn-danger'>Sign Out</a>";
echo "</div>";
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

$sql = "SELECT * FROM PRODUCT_13099";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
	 <tr>
	 <th>PRODUCTCODE</th>
	 <th>BRAND</th>
         <th>TYPE</th>
         <th>SHADE</th>
         <th>SALESPRICE</th>
     
      	</tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["PRODUCTCODE"]."</td>
	     <td>".$row["BRAND"]."</td>
	     <td>".$row["TYPE"]."</td>
	     <td>".$row["SHADE"]."</td>
	     <td>".$row["SALESPRICE"]."</td>";
	     
        
	echo "<td>";
	echo "<a href='updateproduct.php?productcode={$row["PRODUCTCODE"]}' class='btn btn-primary m-r-1em'>Edit</a>";
 	echo " ";
        echo "<a href='#' onclick='delete_user({$row["PRODUCTCODE"]});'  class='btn btn-danger'>Delete</a>";
	echo "</td>";
	   echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
<style>
table, td {
    border: 1px solid black;
    border-collapse: collapse;
    background-color: #FFC0CB;
}
th {
    border: 1px solid black;
    border-collapse: collapse;
    background-color: #FFFFFF;
}
th, td {
    padding: 40px;
}
</style>
<script type='text/javascript'>
// confirm record deletion
function delete_user( productcode ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'deleteproduct.php?productcode=' + productcode;
    } 
}
</script>
</body>
</html>
