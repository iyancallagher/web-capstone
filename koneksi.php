<?php
$con = mysqli_connect("localhost","root","","db_capstone");


if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>