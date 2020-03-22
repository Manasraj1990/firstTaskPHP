<?php
$servername='localhost';
$username='root';
$password='manas98077raj';
$dbname='prologictechnologies';

$conn=mysqli_connect("$servername","$username","$password","$dbname");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>