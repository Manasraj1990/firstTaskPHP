<?php
$user_id ='';
$emp_Id='';
$massage=''; 
$firstname='';
$lastname='';
$emailid='';
$mobileno='';
$photo='';
$gender=''; 
$high_school='';
$intermediate_school='';
$diploma='';
$graduate='';
$masters='';
$servername='localhost';
$username='root';
$password='manas98077raj';
$dbname='prologictechnologies'; 

if(isset($_POST['Submit']))
{  
try{       
               $firstname=$_POST['fname'];
               $lastname=$_POST['lname'];
               $emailid=$_POST['emailid'];
               $mobileno=$_POST['mobno'];
               $imagename= basename($_FILES['photo']['name']);
               $tempname=$_FILES['photo']['tmp_name'];
                   move_uploaded_file($tempname,"./uplodedimages/".$imagename);
               $gender=$_POST['gender'];
               
               if(!isset($_POST['high_school'])){
                $high_school="null";
                }
                else{
                    $high_school=$_POST['high_school'];
                }
               
               if(!isset($_POST['intermediate_school'])){
                       $intermediate_school="null";
                }
                else{
                    $intermediate_school=$_POST['intermediate_school'];
                }
               
               if(!isset($_POST['diploma'])){
                $diploma="null";
                }
                else{
                    $diploma=$_POST['diploma'];
                }
               
               if(!isset($_POST['graduate'])){
                $graduate="null";
                }
                else{
                    $graduate=$_POST['graduate'];
                }
               
               if(!isset($_POST['masters'])){
                $masters="null";
                }
                else{
                    $masters=$_POST['masters'];
                }
                          
               $conn=mysqli_connect("$servername","$username","$password","$dbname");
               $sqlinsert = "INSERT INTO employees(firstname,lastname,emailid,mobileno,photo,gender)
               VALUES ('$firstname','$lastname','$emailid','$mobileno','$imagename','$gender')";
               
               // echo "<meta http-equiv='refresh' content='5'>";

                         
                    if (mysqli_query($conn,$sqlinsert)) 
                    {
                        
                        $massage="Employee information inserted and your ID is:".$conn->insert_id;
                        $emp_Id = $conn->insert_id;
                        $sqlinsertqualification = "INSERT INTO qualification(emp_Id,high_school,intermediate_school,diploma,graduate,masters)
                        VALUES ('$emp_Id','$high_school','$intermediate_school','$diploma','$graduate','$masters')";
                        mysqli_query($conn,$sqlinsertqualification); 
                    }
                    else
                    {
                        $massage="Error occurs";
                    }  
        
    }
catch(Exception $e)
    {
            echo $e->getMessage();
    }              
finally
    {
        mysqli_close($conn);
    }                
}



if (isset($_GET['id'])) {
try{        
                $user_id = base64_decode($_GET['id']); 
                $conn=mysqli_connect("$servername","$username","$password","$dbname");
    // database select query for employees database..
                $sqlselect = "SELECT * FROM employees where id='$user_id'";
                $result=mysqli_query($conn,$sqlselect);
                $data=mysqli_fetch_assoc($result);
                $firstname=$data['firstname'];
                $lastname=$data['lastname'];
                $emailid=$data['emailid'];
                $mobileno=$data['mobileno'];
                $photo=$data['photo'];
                $gender=$data['gender']; 
    // database select query for qualification database..
                $sqlselectqualification="SELECT * FROM qualification where emp_id='$user_id'";
                $result=mysqli_query($conn,$sqlselectqualification);
                $data=mysqli_fetch_assoc($result);
                $high_school=$data['high_school'];
                $intermediate_school=$data['intermediate_school'];
                $diploma=$data['diploma'];
                $graduate=$data['graduate'];
                $masters=$data['masters'];

    }
catch(Exception $e)
    {
            echo $e->getMessage();
    }
finally
    {
        mysqli_close($conn);
    }     
}

 
if (isset($_POST['Update'])) 
{
try{   
            $sqlUpdate="";
            $id=$_POST['id'];
            $firstname=$_POST['fname'];
            $lastname=$_POST['lname'];
            $emailid=$_POST['emailid'];
            $mobileno=$_POST['mobno'];
            $imagename= basename($_FILES['photo']['name']);
            $tempname=$_FILES['photo']['tmp_name'];
            move_uploaded_file($tempname,"./uplodedimages/".$imagename);
            $gender=$_POST['gender'];
            if(!isset($_POST['high_school'])){
                $high_school="null";
                }
                else{
                    $high_school=$_POST['high_school'];
                }
               
               if(!isset($_POST['intermediate_school'])){
                       $intermediate_school="null";
                }
                else{
                    $intermediate_school=$_POST['intermediate_school'];
                }
               
               if(!isset($_POST['diploma'])){
                $diploma="null";
                }
                else{
                    $diploma=$_POST['diploma'];
                }
               
               if(!isset($_POST['graduate'])){
                $graduate="null";
                }
                else{
                    $graduate=$_POST['graduate'];
                }
               
               if(!isset($_POST['masters'])){
                $masters="null";
                }
                else{
                    $masters=$_POST['masters'];
                }

            $conn=mysqli_connect("$servername","$username","$password","$dbname");
            if($imagename=="")
               {
                $sqlUpdate="UPDATE employees SET firstname='$firstname',lastname='$lastname',emailid='$emailid',mobileno='$mobileno'
                ,gender='$gender' WHERE id='$id' ";
               }
            else{   
            $sqlUpdate="UPDATE employees SET firstname='$firstname',lastname='$lastname',emailid='$emailid',mobileno='$mobileno',
                        photo='$imagename',gender='$gender' WHERE id='$id' ";
            }
            // echo "<meta http-equiv='refresh' content='5'>";

                    if (mysqli_query($conn,$sqlUpdate)) 
                    {
                        $massage="Employee information Updated"; 
                        $sqlinsertqualification = "UPDATE qualification SET emp_Id='$id',high_school='$high_school'
                        ,intermediate_school='$intermediate_school',diploma='$diploma',graduate='$graduate',masters='$masters' WHERE emp_id='$id'";
                         mysqli_query($conn,$sqlinsertqualification);   
                    }
                    else{

                        $massage="Error occurs";
                    }
    }
catch(Exception $e)
   {
           echo $e->getMessage();
   }                     
finally
   {
    mysqli_close($conn);
   }
}
  ?>