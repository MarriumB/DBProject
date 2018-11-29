<?php
echo "<div align='right'>";
echo "<a href='welcome.php' class='btn btn-primary m-r-1em'>Home</a>";
echo "<a href = 'logout.php' class='btn btn-danger'>Sign Out</a>";
echo "</div>";
require_once('vendor/autoload.php');
$client=new MongoDB\Client;
$database=$client->selectDatabase('DBProject');
$collection=$database->selectCollection('SURVEY');

	if (isset($_POST['create']))
	{
		$data = [
			'coordinates' => $_POST['d'],
			'shopName' => $_POST['e'],
			'available' => $_POST['available'],
			'front' => $_POST['front'],
			'competitor' => $_POST['competitor'],
			'timestamp' => new MongoDB\BSON\UTCDateTime
		];
		if (isset($_FILES['image']))
		{
			if (move_uploaded_file($_FILES['image']['tmp_name'], "upload/".$_FILES['image']['name'])){
				$data['image'] = $_FILES['image']['name'];
				echo 'FILE MOVED!!';
				header('location: welcome.php');
			}
			else
			{
				echo 'FILE NOT MOVED!';
				echo '<br>';
				echo $_FILES['image']['tmp_name'];
				echo '<br>';
			    echo $_FILES['image']['name'];
			}
			
		}
		else
		{
			echo 'FILE NOT FOUND!';
		}
		$result = $collection->insertOne($data);
		if($result->getInsertedCount() > 0)
		{
			header('location: survey.php');
		}
		else {
			header('location: survey.php');
		}
	}

?>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<body>
<?php

	$forms = $collection->find();
	foreach($forms as $key => $row){
		$UTCDateTime = new MongoDB\BSON\UTCDateTime((string)$row['timestamp']);
		$DateTime = $UTCDateTime->toDateTime();				
      echo' <div class="container" align="center"><table>  
  <div><tr>'.$DateTime->format('d/m/Y H:i:s').'</tr></div>';

  echo '<div><tr>'.$row['shopName'].'</tr></div>';
  echo '<div><tr><strong>Coordinates:</strong>'.$row['coordinates'].'</tr></div>';
  echo '<div><tr><strong> Products available in shop?:</strong>'.$row['available'].'</tr></div>';
  echo '<div><tr><strong> Products positioned in front?:</strong>'.$row['front'].'</tr></div>';
  echo '<div><tr> <strong>Competitor products more prominent?:</strong>'.$row['competitor'].'</tr></div>';
 echo '<div><tr><img src="upload/'.$row['image']. '" width="300" height="200" ></tr></div>';
   echo '</table></div><br>';       


	 }

?>

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
<form action = "survey.php" method="post" enctype="multipart/form-data">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>SHOPNAME</td>
            <td><input type='text' name='e' class='form-control' /></td>
        </tr>
	<tr>
            <td>GEOGRAPHICAL CORDINAETES</td>
            <td><input type='text' name='d' class='form-control' /></td>
        </tr>
	<tr>
            <td>PRODUCTS AVAILABLE?</td>
            <td><input type="radio" name="available" value="Yes">Yes</input>   
	<input type="radio" name="available" value="No"> No </input></td>
        </tr>
	<tr>
            <td>PRODUCTS POSITIONED in front? </td>
            <td>
	<input type="radio" name="front" value="Yes">Yes</input>
	<input type="radio" name="front" value="No">No</input></td>
        </tr>
	<tr>
            <td>COMPETITOR PRODUCTS MORE PROMINENT?</td>
            <td><input type="radio" name="competitor" value="Yes">Yes</input>
	<input type="radio" name="competitor" value="No">No</input></td>
        </tr>
	<tr>
            <td>PICTURE</td>
            <td><input type='file' name='image' class='form-control' /></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Save' name='create' class='btn btn-primary' />
            </td>
        </tr>
    </table>
</form>

</body>
</html>
