<?php
require 'com/config/DBHelper.php';
session_start();
if (isset($_SESSION['username'])) {
    header("location:levels/".$_SESSION['current_level'].".php");
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['username']) && !empty($_POST['password']))    {
        $db = new DBHelper();
        $con = $db->getConnection();


        $username = test_input(filter_input(INPUT_POST, 'username'));
        $password = test_input(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
        $username = $con->real_escape_string($username);
        $password = $con->real_escape_string($password);

        $password = hash("sha512", $password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' and activated=1";
        $res = $con->query($query);
        $r = $res->fetch_assoc();
        if($res->num_rows == 1) {
            $_SESSION['username'] = $username;
            $query1 = "SELECT * FROM track_records WHERE username='$username'";
            $res1 = $con->query($query1);
            $r1 = $res1->fetch_assoc();
            if($res1->num_rows == 1) {
                $_SESSION['current_level'] = $r1['current_level'];
                $_SESSION['total_score'] = $r1['total_score'];
                $_SESSION['current_hint_took'] = $r1['current_hint_took'];
                $_SESSION['on_block'] = $r1['on_block'];
                $_SESSION['when_to_unblock'] = $r1['when_to_unblock'];
            }
            header("levels/{$_SESSION['current_level']}.php");
        }

        //handle login error
    }
}

?>

<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Log In</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css" />
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <!--<link rel="stylesheet" href="css/materialize.css" >-->
        <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <style>
        #login form{
          display: inline-block;
          position: fixed;
          left: 0;
          right: 0;
          margin: auto;
        }
        </style>
        <script>
        $(document).ready(function(){
          $(".button-collapse").sideNav();
        });

        </script>
    </head>
    <body>
      <nav>
            <div class="nav-wrapper">
              <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
              <a href="#" class="brand-logo">hack_it</a>
                <ul id="slide-out" class="side-nav">

                    <li><a href="./lboard.html">LeaderBoard</a></li>
                    <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
                    <li><a href="about.html">About</a></li>
                </ul>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="./lboard.html">Leader Board</a></li>
                    <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
                    <li><a href="about.html">About</a></li>
                </ul>
            </div>
        </nav>
    &nbsp; &nbsp;
    <div class="row" id="login">

    <form class="col s6" action="login.php" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input id="username" name="username" type="text" class="validate">
          <label for="username">Username</label>
        </div>
        <div class="input-field col s12">
            <i class="material-icons prefix">lock</i>
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
          <button class="btn waves-effect waves-light right-align-align" type="submit" name="action" style="float: right" >LogIn
          <i class="fa fa-sign-in right" aria-hidden="true"></i>
        </button>
        </div>
    </form>
  </body>
</html>
