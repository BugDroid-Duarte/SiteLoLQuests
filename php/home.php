<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.html");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>
