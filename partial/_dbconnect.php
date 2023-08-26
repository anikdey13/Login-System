<?php 
$conn = mysqli_connect("localhost","root","","users");
if(!$conn){
    die("sorry we failed to connect". mysqli_connect_errno());
  }

?>