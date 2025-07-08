<?php
// Database credentials from docker-compose.yml
$db_host = "db"; // Service name defined in docker-compose.yml
$db_user = "msmsuser"; // As defined in docker-compose.yml
$db_pass = "msmspassword"; // As defined in docker-compose.yml
$db_name = "msmsdb"; // As defined in docker-compose.yml

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if(mysqli_connect_errno()){
  // It's better to log errors or handle them gracefully than echoing directly,
  // but for keeping consistency with the original style:
  echo "Connection Fail: " . mysqli_connect_error();
  // Consider exiting or throwing an exception in a real application
  // exit("Database connection failed: " . mysqli_connect_error());
}
?>
