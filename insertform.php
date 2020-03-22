<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("queries.php");  
?>
<!DOCTYPE html>
<html>

<head>
    <title>insert form</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
    #button {
        display: block;
        width: 200px;
        height: 25px;
        background: #4E9CAF;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        color: white;
    }

    a {
        text-decoration: none;
    }
    </style>
</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">
        <table style=" border: 1px solid;padding: 50px;box-shadow: 5px 10px 8px #888888;padding: 50px;">
            <tr> <?php
      if(isset($_GET['id'])){
          ?>
                <h1>Update Details</h1>
                <?php
      }
      else{
        ?>
                <h1>Insert</h1>
                <?php
      }
  ?></tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $user_id ; ?>"></td>
                <td><span><?php echo $massage; ?></span></td>
                <td id="button"><a  href="index.php">Check Registered Employees</a></td>
            </tr>
            <tr>
                <td><label>First name:</label></td>
                <td><input type="text" name="fname" placeholder="Enter First Name"
                        value="<?php echo $fatch_firstname ;?>"></td>
            </tr>

            <tr>
                <td><label>Last name:</label></td>
                <td><input type="text" name="lname" placeholder="Enter Last Name"
                        value="<?php echo $fatch_lastname ; ?>"></td>
            </tr>

            <tr>
                <td><label>Email ID:</label></td>
                <td><input type="email" name="emailid" placeholder="Enter Email ID"
                        value="<?php echo $fatch_emailid ; ?>"></td>
            </tr>

            <tr>
                <td><label> Mobile Number:</label></td>
                <td><input type="text" name="mobno" placeholder="Enter Mobile Number"
                        value="<?php echo $fatch_mobileno ;?>"></td>
            </tr>

            <tr>
                <td><label>Photo:</label></td>

                <td><input type="file" name="photo" value="<?php echo $fatch_photo ;?>">
                    <img width="100px" height="120px" src="./uplodedimages/<?php echo $fatch_photo;?>"
                        alt="Your picture "></td>
            </tr>

            <tr>
                <td><label>Gender:</label></td>
                <td><input type="radio" name="gender" value="male" <?php if( $fatch_gender=="male"){ echo "checked";}?>>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="female"
                        <?php if( $fatch_gender=="female"){ echo "checked";}?>>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="other"
                        <?php if( $fatch_gender=="other"){ echo "checked";}?>>
                    <label for="other">Other</label></td>
            </tr>
            <tr>
                <td><label>Qualification:</label></td>
                <td> <input type="checkbox" name="high_school" value="High_school"
                        <?php if($fatch_high_school=="High_school"){ echo "checked";}?>>
                    <label> High school</label>
                    <input type="checkbox" name="intermediate_school" value="Intermediate_school"
                        <?php if($fatch_intermediate_school=="Intermediate_school"){ echo "checked";}?>>
                    <label>Intermediate school</label>
                    <input type="checkbox" name="diploma" value="Diploma"
                        <?php if($fatch_diploma=="Diploma"){ echo "checked";}?>>
                    <label> Diploma</label>
                    <input type="checkbox" name="graduate" value="Graduate"
                        <?php if($fatch_graduate=="Graduate"){ echo "checked";}?>>
                    <label> Graduate</label>
                    <input type="checkbox" name="masters" value="Masters"
                        <?php if($fatch_masters=="Masters"){ echo "checked";}?>>
                    <label>Masters</label></td>
            </tr>
            <tr>
                <td>
                    <lable>Degrees:</lable>
                </td>
                <td> <select name="degrees[]" multiple>
                        <option value="Poly" <?php echo $GLOBALS["poly"]; ?>>Poly</option>
                        <option value="B.tech" <?php echo $GLOBALS["btech"]; ?>>B.tech</option>
                        <option value="MBA" <?php echo $GLOBALS["mba"]; ?>>MBA</option>
                        <option value="M.tech" <?php echo $GLOBALS["mtech"]; ?>>M.tech</option>
                    </select></td>
            </tr>
            <tr>
                <td><input type="submit" name="<?php
     if(isset($_GET['id'])){
         echo "Update";
     }
     else{
         echo "Submit";
            }
     ?>" value="<?php
     if(isset($_GET['id'])){
         echo "Update";
     }
     else{
         echo "Save";
            }
     ?>
     "></td>
                <td><?php if(!isset($_GET['id'])){
                   echo "<input type=reset name=reset value=Reset>";}
                ?>
                </td>
            </tr>
        </table>
    </form>   
</body>