<?php

//dados necessarios para a funçao msqli_connect.
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "lolquests");

//verificar se a ligação foi feita com sucesso.
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE) or die('Error');
  if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
