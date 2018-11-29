<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted1'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
echo "<div align='right'>";
   echo "<a href='createsalesperson_13099.php' class='btn btn-primary m-r-1em'>Create</a>";
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

$sql = "SELECT * FROM SALESPERSONN_13099";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
	 <tr>
	 <th>NAME</th>
	 <th>CONTACT</th>
         <th>ID</th>
         <th>SPID</th>
         
	 </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["NAME"]."</td>
	     <td>".$row["CONTACT"]."</td>
             <td>".$row["ID"]."</td>
	     <td>".$row["SPID"]."</td>";
	echo "<td>";
	echo "<a href='updatesalesperson_13099.php?id={$row["ID"]}' class='btn btn-primary m-r-1em'>Edit</a>";
 	echo " ";
        echo "<a href='#' onclick='delete_user({$row["ID"]});'  class='btn btn-danger'>Delete</a>";
     
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
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'deletesalesperson_13099.php?id=' + id;
    } 
}
</script>
</body>
</html>
