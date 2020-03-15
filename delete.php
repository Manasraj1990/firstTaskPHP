<?php

if(isset($_GET['id']))
{
  $user_id= base64_decode($_GET['id']);
  $servername='localhost';
  $username='root';
  $password='manas98077raj';
  $dbname='prologictechnologies'; 
try{
  $conn=mysqli_connect("$servername","$username","$password","$dbname");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
     }

// sql to delete a record
$conn->begin_Transaction();
$sqldelete = "DELETE FROM employees WHERE id=$user_id";
$sqldeletequalification="DELETE FROM qualification WHERE emp_id=$user_id";;

if (mysqli_query($conn,$sqldelete) === TRUE && mysqli_query($conn,$sqldeletequalification)===True) {
    echo "Record deleted successfully";
    echo "<meta http-equiv='refresh' content='5'>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
$conn->commit();
}
catch(Exception $e)
{
    
    $conn->rollBack();
    echo $e->getMessage();

}
finally
{
    mysqli_close($conn);

}

}
?>