<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "lolquests");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die('Oops');
//verificar se a ligação foi feita com sucesso
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if (isset($_POST['name']) && isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['password'])) {

  echo "isset";
  $name = $_POST['name'];
  $nickname = $_POST['nickname'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query = "INSERT INTO users (name, nickname, email, password) VALUES ('$name', '$nickname', '$email', '$password' )";
  $insert = mysqli_query($con, $query) or die (mysqli_error($con));

  if ($insert) {
        echo "sucess";
     } else {
        echo "RIP";
     }
  } else {
    var_dump($insert);
  }

?>
