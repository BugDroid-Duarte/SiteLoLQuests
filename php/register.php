<?php

 ob_start();
 session_start();

 if(isset($_SESSION['user'])!=""){
  header("Location: index.html");
 }

 include_once 'dbconnect.php';

 $error = false;

// em vez de fazer isset nas variaveis todas, podemos fazer apenas no botao.
if (isset($_POST['name']) && isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['password'])) {
  // limpa os campos
  $name = trim($_POST['name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);

  $nickname = trim($_POST['nickname']);
  $nickname = strip_tags($nickname);
  $nickname = htmlspecialchars($nickname);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);

  // verifica se é um email valido, se for verifica se ja existe na base de dados.
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
   echo $emailError;
  } else {
   // check email exist or not
   $query = "SELECT email FROM users WHERE email='$email'";
   $result = mysqli_query($con, $query) or die(mysqli_error($con));
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }

  // password encrypt using SHA256();
  $password = hash('sha256', $password);

  // if there's no error, continue to signup
  if( !$error ) {
    echo "chega aqui ?";
    $query = "INSERT INTO users (name, nickname, email, password) VALUES ('$name', '$nickname', '$email', '$password' )";
    $insert = mysqli_query($con, $query) or die (mysqli_error($con));

     if ($insert) {
      $errTyp = "Sucess";
      $errMSG = "Successfully registered, you may login now";
      unset($name);
      unset($email);
      unset($pass);
      header("Location: ../index.html");
     } else {
      $errTyp = "danger";
      $errMSG = "Something went wrong, try again later...";
     }
  }
}
