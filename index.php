<?php
 ob_start();
 session_start();
 require_once './php/dbconnect.php';

 // it will never let you open index(login) page if session is set
 if (isset($_SESSION['user'])!="") {
  header("Location: profile.html");
  exit;
 }

 $error = false;

 if (isset($_POST['email']) && isset($_POST['password'])) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);
  // prevent sql injections / clear user invalid inputs

  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }

  if(empty($password)){
   $error = true;
   $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {

   $password = hash('sha256', $password); // password hashing using SHA256

   $res=mysqli_query($con, "SELECT id, nickname, password FROM users WHERE email='$email'");
   $row=mysqli_fetch_array($res);
   $count = mysqli_num_rows($res);

   // if uname/pass correct it returns must be 1 row
   if( $count == 1 && $row['password']=$password) {
    $_SESSION['user'] = $row['id'];
    header("Location: profile.html");
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }
  }
 }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css" >
    <link rel="stylesheet" href="./css/orlando.css" >
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=" Pagina Inicial ">

</head>

<body>

<div id="wrapper">
    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
        <ul class="nav sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                   <img src="./img/logo2.png" alt="">
                </a>
            </li>
            <li>
                <a href="index.php">Login</a>
            </li>
            <li>
                <a href="register.html">Register</a>
            </li>
            <li>
                <a href="about.html">About</a>
            </li>
            <li>
                <a href="profile.html">Profile</a>
            </li>
            <li>
                <a href="matchhistory.html">Match History</a>
            </li>
            <li>
                <a href="leaderboard.html">Leaderboard</a>
            </li>
            <li>
                <a href="contacts.html">Contacts</a>
            </li>
            <li>
                 <a href="./php/logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="page-content-wrapper">
          <nav class="navbar navbar-default navbar-static-top">

            <div class="container" style="width: 100%;">
              <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                  <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
          <span class="hamb-bottom"></span>
              </button>
              <div class="navbar-header">
                  <a class="navbar-brand" href="./index.html"target="_self" style="margin-left: 55px;"> <img src="./img/logo.png" alt=""></a>
             </div>
            </div>
          </nav>

          <form class="form-signin" action="index.php" method="post">
            <h2 class="form-signin-heading">Please login</h2>
            <input type="text" class="form-control" name="email" placeholder="Username" required="" autofocus="" />
            <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
            <label class="checkbox">
              <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
            </label>
            <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Login</button>
          </form>


    <!-- /#page-content-wrapper -->
  </div>
</div>

<!-- /#wrapper -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/master.js"></script>
</html>
<?php ob_end_flush(); ?>
