<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("insert.php");



?>

<!DOCTYPE html>
<html>

<head>
    <title>insert form</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">
        <table style=" border: 1px solid;padding: 50px;box-shadow: 5px 10px 8px #888888;padding: 50px;">
            <tr> <?php
      if(isset($_POST['Edit'])){
          ?>
                <h1>Update Detail</h1>
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
            </tr>
            <tr>
                <td><label>First name:</label></td>
                <td><input type="text" name="fname" value="<?php echo $firstname ; ?>"></td>
            </tr>

            <tr>
                <td><label>Last name:</label></td>
                <td><input type="text" name="lname" value="<?php echo $lastname ; ?>"></td>
            </tr>

            <tr>
                <td><label>Email ID:</label></td>
                <td><input type="Email" name="emailid" value="<?php echo $emailid ; ?>"></td>
            </tr>

            <tr>
                <td><label> Mobile Number:</label></td>
                <td><input type="number" name="mobno" value="<?php echo $mobileno ;?>"></td>
            </tr>

            <tr>
                <td><label>Photo:</label></td>
                <td><input type="file" name="photo" value="<?php echo $photo ;?>">
                    <img width="60px" height="100px" src="./uplodedimages/<?php echo $photo ?>" alt="sorry"></td>
            </tr>

            <tr>
                <td><label>Gender:</label></td>
                <td><input type="radio" name="gender" value="male" <?php if( $gender=="male"){ echo "checked";}?>>
                    <label for="male">Male</label>
                    <input type="radio" name="gender" value="female" <?php if( $gender=="female"){ echo "checked";}?>>
                    <label for="female">Female</label>
                    <input type="radio" name="gender" value="other" <?php if( $gender=="other"){ echo "checked";}?>>
                    <label for="other">Other</label></td>
            </tr>


            <tr>
                <td><label>Qualification:</label></td>
                <td> <input type="checkbox" name="high_school" value="High_school">
                    <label> High school</label>
                    <input type="checkbox" name="intermediate_school" value="Intermediate_school">
                    <label>Intermediate school</label>
                    <input type="checkbox" name="diploma" value="Diploma">
                    <label> Diploma</label>
                    <input type="checkbox" name="graduate" value="Graduate">
                    <label> Graduate</label>
                    <input type="checkbox" name="masters" value="Masters">
                    <label>Masters</label></td>
            </tr>
            <tr>
                <td>
                    <lable>Degrees:</lable>
                </td>
                <td> <select name="degrees" multiple>
                        <option value="Poly">Poly</option>
                        <option value="B.tech">B.tech</option>
                        <option value="MBA">MBA</option>
                        <option value="M.tech">M.tech</option>
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

                <td><span><?php echo $massage; ?></span></td>
            </tr>

            <tr>
                <td><input type="submit" name="showinfo" formaction="showdata.php" value="Check Data"></td>
            </tr>

        </table>
    </form>   