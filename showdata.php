<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("delete.php");
?>

<html>

<head>
    <title>Users data</title>
    <style>
    body {
        background-color: #FFF0F5;
    }

    input {
        background-color: Red;
    }

    th,
    td {
        border: 1px solid black;
        text-align: left;
    }

    table {
        width: 100%;
        padding: 10px;
        box-shadow: 5px 10px 8px #888888;
    }
    </style>
</head>

<body>
    <?php

$servername='localhost';
$username='root';
$password='manas98077raj';
$dbname='prologictechnologies';
try{
$conn=mysqli_connect("$servername","$username","$password","$dbname");
$conn->begin_Transaction();
$sqlselect = "SELECT * FROM employees";
  
echo '<table >
      <tr> 
          <th> <font face="Arial">ID</font> </th> 
          <th> <font face="Arial">First Name</font> </th> 
          <th> <font face="Arial">Last Name</font> </th> 
          <th> <font face="Arial">Email</font> </th> 
          <th> <font face="Arial">Mobile Number</font> </th> 
          <th> <font face="Arial">Photo</font> </th> 
          <th> <font face="Arial">Gender</font> </th>
          <th> <font face="Arial">Qualification</font> </th>
          <th> <font face="Arial">Degrees</font> </th>
          <th> <font face="Arial">Edit</font> </th> 
          <th> <font face="Arial">Delete</font> </th>   
      </tr>';
 
if ($result=mysqli_query($conn,$sqlselect)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $field1name = $row["Id"];
        $field2name = $row["firstname"];
        $field3name = $row["lastname"];
        $field4name = $row["emailid"];
        $field5name = $row["mobileno"];
        $field6name = $row["photo"]; 
        $field7name = $row["gender"]; 
 
        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td> 
                  <td>'.$field6name.'</td> 
                  <td>'.$field7name.'</td>
                  <td><a href=showDataQUalificationDegrees.php?id='.base64_encode($field1name).'>Qualification</a></td>
                  <td><a href=showDataDegrees.php?id='.base64_encode($field1name).'>Degrees</a></td>
                  <td><a href=index.php?id='.base64_encode($field1name).'>Edit</a></td>
                  <td><a href=showdata.php?id='.base64_encode($field1name).'>Delete</a></td>
                    </tr>';
    }
    mysqli_free_result($result);
}
$conn->commit();
}
catch(Exception $e){
    $conn->rollBack();
    echo $e->getMessage();
}
finally{
    mysqli_close($conn);} 
?>
</body>

</html>