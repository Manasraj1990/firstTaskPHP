<?php
if(isset($_GET['id']))
{
  $user_id= base64_decode($_GET['id']);
  $servername='localhost';
  $username='root';
  $password='manas98077raj';
  $dbname='prologictechnologies'; 
  $conn=mysqli_connect("$servername","$username","$password","$dbname");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sqldelete = "DELETE FROM employees WHERE id=$user_id";

if (mysqli_query($conn,$sqldelete) === TRUE) {
    echo "Record deleted successfully";
    echo "<meta http-equiv='refresh' content='5'>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);

}
?>