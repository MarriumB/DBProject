<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='deleted1'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
echo "<div align='right'>";
   echo "<a href='createuser.php' class='btn btn-primary m-r-1em'>Create</a>";
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

$sql = "SELECT * FROM USER_13099";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>
	 <tr>
	 <th>USERNAME</th>
	 <th>PASSWORD</th>
         <th>SPID</th>
         </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
	     <td>".$row["USERNAME"]."</td>
	     <td>".$row["PASSWORD"]."</td>
             <td>".$row["SPID"]."</td>";          
	echo "<td>";
	echo "<a href='updateuser.php?username={$row["USERNAME"]}' class='btn btn-primary m-r-1em'>Edit</a>";
 	echo " ";
        echo "<a href='deleteuser.php?username={$row["USERNAME"]}' class='btn btn-danger'>Delete</a>";
     
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
</body>
</html>
