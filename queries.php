<?php
require_once("variables.php");
require_once("dbConnection.php");

?>
<?php
function error($err)
{
 throw new Exception("There is some error:".$err);
}
try{
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
            $degrees=$_POST['degrees'];
            
            mysqli_begin_transaction($conn);  
            $sqlinsert = "INSERT INTO employees(firstname,lastname,emailid,mobileno,photo,gender) VALUES ('$firstname','$lastname','$emailid','$mobileno','$imagename','$gender')";
            // echo "<meta http-equiv='refresh' content='5'>";
            
                mysqli_query($conn,$sqlinsert) or error(mysqli_error($conn)); 
                $emp_id = $conn->insert_id;
                $sqlinsertqualification = "INSERT INTO qualification(emp_id,high_school,intermediate_school,diploma,graduate,masters) VALUES ('$emp_id','$high_school','$intermediate_school','$diploma','$graduate','$masters')";
                mysqli_query($conn,$sqlinsertqualification) or error(mysqli_error($conn)); 
                foreach ($degrees as $course)
                {
                    $sqlinsertempdegrees = "INSERT INTO empdegrees(emp_id,course)";
                    $sqlinsertempdegrees.= "VALUES ('$emp_id','".mysqli_real_escape_string($conn,$course)."')";
                    mysqli_query($conn,$sqlinsertempdegrees) or error(mysqli_error($conn));
                    $massage="your data inserted successfully GENERATED ID:".$emp_id."";
                }
                mysqli_commit($conn);
        }   
        catch(Exception $e)
            {
                mysqli_rollBack($conn);   
                echo $e->getMessage();
            }                           
    }



    if (isset($_GET['id'])) 
    {
        try{        
                $user_id = base64_decode($_GET['id']); 
        // database select query for employees database..
                $sqlselect = "SELECT employees.id,employees.firstname,employees.lastname,employees.emailid,employees.mobileno,
                employees.photo,employees.gender,qualification.high_school, qualification.intermediate_school,qualification.diploma,qualification.graduate,qualification.masters,GROUP_CONCAT(course) 
                as course FROM employees inner join qualification on employees.id= qualification.emp_id inner join empdegrees 
                on employees.id = empdegrees.emp_id group by empdegrees.emp_id";
                $result=mysqli_query($conn,$sqlselect);
            mysqli_num_rows($result) > 0 or error(mysqli_error($conn));
                $data=mysqli_fetch_assoc($result);
                $fatch_firstname=$data['firstname'];
                $fatch_lastname=$data['lastname'];
                $fatch_emailid=$data['emailid'];
                $fatch_mobileno=$data['mobileno'];
                $fatch_photo=$data['photo'];
                $fatch_gender=$data['gender'];
                $fatch_high_school=$data['high_school'];
                $fatch_intermediate_school=$data['intermediate_school'];
                $fatch_diploma=$data['diploma'];
                $fatch_graduate=$data['graduate'];
                $fatch_masters=$data['masters'];
                $fatch_courses=$data['course'];
                $course=explode(",",$fatch_courses);
                foreach($course as $value){        
                    if($value=="Poly"){
                        $GLOBALS["poly"]="selected";
                    }
                    elseif($value=="B.tech"){
                        $GLOBALS["btech"]="selected";
                    }
                    elseif($value=="M.tech"){
                        $GLOBALS["mtech"]="selected";
                    }
                    elseif($value=="MBA"){
                        $GLOBALS["mba"]="selected";
                    }
                    else{

                    }
                }
        }     
        catch(Exception $e)
            {   
                echo $e->getMessage();
            }
        
    }

    
    if (isset($_POST['Update'])) 
    {
        try{   require_once("dbConnection.php");
                $sqlUpdate="";
                $update_id=$_POST['id'];
                $update_firstname=$_POST['fname'];
                $update_lastname=$_POST['lname'];
                $update_emailid=$_POST['emailid'];
                $update_mobileno=$_POST['mobno'];
                $update_imagename= basename($_FILES['photo']['name']);
                $update_tempname=$_FILES['photo']['tmp_name'];
                move_uploaded_file($update_tempname,"./uplodedimages/".$update_imagename);
                $update_gender=$_POST['gender'];
                if(!isset($_POST['high_school'])){
                    $update_high_school="null";
                }
                else{
                    $update_high_school=$_POST['high_school'];
                }    
                if(!isset($_POST['intermediate_school'])){
                    $update_intermediate_school="null";
                }
                else{
                    $update_intermediate_school=$_POST['intermediate_school'];
                }
                if(!isset($_POST['diploma'])){
                    $update_diploma="null";
                }
                else{
                    $update_diploma=$_POST['diploma'];
                }   
                if(!isset($_POST['graduate'])){
                    $update_graduate="null";
                }
                else{
                        $update_graduate=$_POST['graduate'];
                    }   
                if(!isset($_POST['masters'])){
                    $update_masters="null";
                    }
                else{
                        $update_masters=$_POST['masters'];
                    }
                $update_degrees=$_POST['degrees'];
                
                mysqli_begin_transaction($conn);  
                if($update_imagename==""){      
                $sqlUpdate="UPDATE employees SET firstname='$update_firstname',lastname='$update_lastname',emailid='$update_emailid',mobileno='$update_mobileno',gender='$update_gender' WHERE id='$update_id'";
                }
                else{   
                $sqlUpdate="UPDATE employees SET firstname='$update_firstname',lastname='$update_lastname',emailid='$update_emailid',mobileno='$update_mobileno',photo='$update_imagename',gender='$update_gender' WHERE id='$update_id' ";
                }
                // echo "<meta http-equiv='refresh' content='5'>";
                mysqli_query($conn,$sqlUpdate) or error(mysqli_error($conn)); 
                    $massage="Employee information Updated"; 
                    $sqlinsertqualification = "UPDATE qualification SET emp_id='$update_id',high_school='$update_high_school',intermediate_school='$update_intermediate_school',diploma='$update_diploma',graduate='$update_graduate',masters='$update_masters' WHERE emp_id='$update_id'";
                mysqli_query($conn,$sqlinsertqualification)or error(mysqli_error($conn)); 
                        $sqldeleteempdegrees= "DELETE FROM empdegrees WHERE emp_id='$update_id'";
                mysqli_query($conn,$sqldeleteempdegrees) or error(mysqli_error($conn));    
                          foreach ($update_degrees as $update_course)
                            {
                                $sqlinsertempdegrees = "INSERT INTO empdegrees(emp_id,course) VALUES ('$update_id','".mysqli_real_escape_string($conn,$update_course)."')";
                                mysqli_query($conn,$sqlinsertempdegrees);        
                            }
                mysqli_commit($conn);
                header("Location:index.php?iID=".base64_encode($update_id));
        }
        catch(Exception $e)
        {
        mysqli_rollBack($conn);       
        echo $e->getMessage();
        }                     
        finally
        {
        
        }
    }
}
catch(Exception $e)
{
    echo getMassage($e);
}
finally{
   mysqli_close($conn); 
}    
?>