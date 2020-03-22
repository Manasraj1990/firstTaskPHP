<?php
require_once("dbConnection.php")
?>
<?php
function error($err)
{
 throw new Exception(mysqli_error("There is some error:".$err));
}
if(isset($_GET['id']))
  {
  $user_id= base64_decode($_GET['id']);
  try{
    // sql to delete a record
    mysqli_begin_transaction($conn);
    $sqldelete = "DELETE FROM employees WHERE id=$user_id";
    $sqldeletequalification="DELETE FROM qualification WHERE emp_id=$user_id";
    $sqldeleteempdegrees= "DELETE FROM empdegrees WHERE emp_id='$user_id'";
      

    mysqli_query($conn,$sqldelete) && mysqli_query($conn,$sqldeletequalification) && mysqli_query($conn,$sqldeleteempdegrees) or error(mysqli_error($conn));
    echo "Record deleted successfully";
    
    mysqli_commit($conn);
  }
  catch(Exception $e)
  {
    mysqli_rollBack($conn);
    echo $e->getMessage();
  }
  finally
  {
    mysqli_close($conn);
  }

}
?>