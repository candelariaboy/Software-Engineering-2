<?php
	$servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "msc_sup";

      // Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
// sql to delete a record
$desc = $_POST['description'];

$sql = "UPDATE `item_request` SET `status` = 'Unreturned Items', `description` = '$desc' WHERE `item_request`.`trans_id` = $id;";
if (mysqli_query($conn, $sql)) {
  echo "Record deleted successfully";
  header('location:archivesitemreq.php');
} 
else {
  echo "Error deleting record: " . mysqli_error($conn);
}


mysqli_close($conn);
      ?>
      
      

