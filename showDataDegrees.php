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
if(isset($_GET['id'])){
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
        $conn->begin_Transaction();
        $sqlselectqualification="SELECT *
        FROM empdegrees where emp_id='$user_id'";       
        echo '<table >
            <tr> 
                <th> <font face="Arial">ID</font> </th> 
                <th> <font face="Arial">Degrees</font> </th> 
            </tr>';
        
        if ($result=mysqli_query($conn,$sqlselectqualification)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $field1name = $row["emp_id"];
                $field2name = $row["course"];  
                echo '<tr> 
                        <td>'.$field1name.'</td> 
                        <td>'.$field2name.'</td> 
                        </tr>';
                
            }
            echo    '<a href=showdata.php>Back To Employees Table </a>';
            mysqli_free_result($result);
        }
$conn->commit();
    }
catch(Exception $e){
            $conn->rollBack();
            echo $e->getMessage();
        }      

        mysqli_close($conn);
} 
?>
    <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

</body>

</html>