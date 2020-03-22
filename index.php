<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("delete.php");
?>
<?php
 if (isset($_GET['iID'])){
    echo "<p>Update data</p>";  
}
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
    th{
        border: 1px solid black;
        text-align: center;
    }
    td {
        border: 1px solid black;   
        text-align: center;
    }
    .button {
    display: block;
    width: 150px;
    height: 25px;
    background: #4E9CAF;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    }
    .butUpdate {
    display: block;
    width: 100px;
    height: 20px;
    background: green;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    }
    .butDelete {
    display: block;
    width: 100px;
    height: 20px;
    background: red;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    }
a{text-decoration: none;}

    table {
        width: 100%;
        padding: 10px;
        box-shadow: 5px 10px 8px #888888;
    }
    </style>
</head>

<body>


<?php
try{
        $field13name="";    
        $servername='localhost';
        $username='root';
        $password='manas98077raj';
        $dbname='prologictechnologies';
        $conn=mysqli_connect("$servername","$username","$password","$dbname");
        $sqlselect ="SELECT employees.id,employees.firstname,employees.lastname,employees.emailid,employees.mobileno,
        employees.photo,employees.gender,qualification.high_school, qualification.intermediate_school,qualification.diploma,qualification.graduate,qualification.masters,GROUP_CONCAT(course) 
        as course FROM employees inner join qualification on employees.id= qualification.emp_id inner join empdegrees 
        on employees.id = empdegrees.emp_id group by empdegrees.emp_id";
        $select_result= mysqli_query($conn,$sqlselect);
        
        echo '<table >
            <tr> 
                <th> <font face="Arial">ID</font> </th> 
                <th> <font face="Arial">First Name</font> </th> 
                <th> <font face="Arial">Last Name</font> </th> 
                <th> <font face="Arial">Email</font> </th> 
                <th> <font face="Arial">Mobile Number</font> </th> 
                <th> <font face="Arial">Photo</font> </th> 
                <th> <font face="Arial">Gender</font> </th>
                <th > <font face="Arial">Qualification</font> </th>
                <th> <font face="Arial">course</font> </th>
                <th> <font face="Arial">Edit</font> </th> 
                <th> <font face="Arial">Delete</font> </th> 

            </tr>';
            mysqli_num_rows($select_result) > 0 or error(mysqli_error($conn));
            while ($row1 = mysqli_fetch_assoc($select_result)) {
                    $field1name = $row1["id"];
                    $field2name = $row1["firstname"];
                    $field3name = $row1["lastname"];
                    $field4name = $row1["emailid"];
                    $field5name = $row1["mobileno"];
                    $field6name = $row1["photo"]; 
                    $field7name = $row1["gender"]; 
                    $field8name = $row1["high_school"];
                    $field9name = $row1["intermediate_school"];
                    $field10name = $row1["diploma"];
                    $field11name = $row1["graduate"];
                    $field12name = $row1["masters"];
                    $field13name = $row1["course"];
                    $str="";
                    if($field8name== "High_school"){
                        $str=$str.$field8name.",";
                    }
                    if($field9name=="Intermediate_school"){
                        $str=$str. $field9name.",";
                    }
                    if($field10name=="Diploma"){
                        $str=$str. $field10name.",";
                    }
                    if($field11name=="Graduate"){
                        $str=$str.$field11name.",";
                    }
                    if($field12name=="Masters"){
                        $str=$str.$field12name.",";
                    }
                    echo '<tr> 
                    <td>'.$field1name.'</td> 
                    <td>'.$field2name.'</td> 
                    <td>'.$field3name.'</td> 
                    <td>'.$field4name.'</td> 
                    <td>'.$field5name.'</td> 
                    <td>'.$field6name.'</td> 
                    <td>'.$field7name.'</td>
                    <td>'.rtrim($str,",").'</td>
                    <td>'.$field13name.'</td>
                    <td><a class=butUpdate href=insertform.php?id='.base64_encode($field1name).'>Update</a></td>
                    <td><a class=butDelete href=index.php?id='.base64_encode($field1name).'>Delete</a></td></tr>';       
            }
            echo '</br><a class=button href=insertform.php> Add Employee </a><br/>';
}      
catch(Exception $e){
    
    echo $e->getMessage();
}
finally{
    mysqli_close($conn);
} 
?>
</body>

</html>