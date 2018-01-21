<?php
require 'mailer.php';
require 'com/config/DBHelper.php';
session_start();
if (isset($_SESSION['username'])) {
    header("location:/".$_SESSION['current_level'].".php");
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['college'])) {
        $db = new DBHelper();
        $con = $db->getConnection();
        $error_flag = false;

        $username = test_input(filter_input(INPUT_POST, 'username'));
        $password = test_input(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = test_input(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $phone = test_input(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
        $college = test_input(filter_input(INPUT_POST, 'college', FILTER_SANITIZE_STRING));

        $username = $con->real_escape_string($username);
        $password = $con->real_escape_string($password);
        $email = $con->real_escape_string($email);
        $phone = $con->real_escape_string($phone);
        $college = $con->real_escape_string($college);

        $password = hash("sha512", $password);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))  {
            $emailError = "Invalid email format";
            $error_flag = true;
        }
        else    {
            $query = "SELECT email FROM users WHERE email='$email'";
            $res = $con->query($query);
            $r = $res->fetch_assoc();
            if(!empty($r['email']) && $r['email']==$email){
				$emailError = "Email is already registered.";
				$error_flag = true;
			}
        }

        if(!preg_match("/^[a-zA-Z0-9 ]*$/",$username)) {
            $usernameError = "Only letters, white space and numbers allowed in username";
            $error_flag = true;
        }
        else    {
            $query = "SELECT username FROM users WHERE username='$username'";
            $res = $con->query($query);
            $r = $res->fetch_assoc();
            if(!empty($r['username']) && $r['username']==$username){
				$usernameError = "Username already in use.";
				$error_flag = true;
			}
        }

        if(!preg_match("/^[0-9]*$/",$phone)) {
            $phoneError = "Enter valid phone number";
            $error_flag = true;
        }

        if(!preg_match("/^[a-zA-Z ]*$/",$college)) {
            $collegeError = "Only letters and white space allowed";
            $error_flag = true;
        }

        if($error_flag == false)    {
            //register if no error
            $confirmation_code = hash("sha512", uniqid(rand()));
            if(!empty($username) && !empty($email) && !empty($password) && !empty($phone) && !empty($college))  {
                $hash = uniqid(rand());
                $query = "INSERT INTO users(username,email,password,phone,college,hash) VALUES ('$username','$email','$password','$phone','$college','$hash')";
                $res = $con->query($query);
                if($res)    {
                    try {
                        //Recipients
                        $mail->setFrom('open.weavers@linuxmail.org', 'hack_it, LCC SJCE');
                        $mail->addAddress($email);               // Name is optional

                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Account Confirmation Link';
                        $mail->Body    = 'Click on this <a href="'.$root_path.'confirm.php?m=c&u='.$username.'&h='.$hash.'"><b>link</b></a>
                                  to activate your hack_it account.';
                        $mail->AltBody = 'A hack_it account was created using this email.Click on this link to confirm activation';

                        $mail->send();
                    }
                    catch (Exception $e) {
                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    }
                    $date = date('Y-m-d H:i:s');

                    $query = "INSERT INTO track_records(username, current_level, total_score, current_hint_took, on_block, when_to_unblock) VALUES ('$username',0,0,0,0,'$date')";
                    $res = $con->query($query);
                    header("location:signup_success.php");
                }
            }
            else    {
                $error = "Enter all fields";
            }
        }

    }
}

?>

<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>SignUp</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
        <!-- Place favicon.ico in the root directory -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css" />
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <!--<link rel="stylesheet" href="css/materialize.css" >-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" href="css/main.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <style>
        #sgnupform form{
          display: inline-block;
          position: fixed;
          left: 0;
          right: 0;
          margin: auto;
        }
        </style>
    </head>
    <body>
      <nav>
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo">Hack_It</a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="#">Leaderboard</a></li>
            <li><a href="#">r/hack_it</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Sign Out</a></li>
          </ul>
          <ul class="side-nav" id="mobile-demo">
            <li><a href="#">Leaderboard</a></li>
            <li><a href="#">r/hack_it</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Sign Out</a></li>
          </ul>
        </div>
    </nav>
      &nbsp; &nbsp;
    <div class="row" id="sgnupform">

    <form class="col s6" action="signup.php" method="post">
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix">account_circle</i>
          <input name="username" id="icon_prefix" type="text" class="validate">
          <label for="icon_prefix">Username</label>
        </div>
        <div class="input-field col s12">
          <input name="password" id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">phone</i>
          <input name="phone" id="icon_telephone" type="tel" class="validate">
          <label for="icon_telephone">Telephone</label>
        </div>
        <div class="input-field col s12">
          <input name="email" id="email" type="email" class="validate">
          <label for="email" data-error="wrong" data-success="right">Email</label>
        </div>
          <div class="input-field col s12">
              <input name="college" id="college" type="text" class="validate">
              <label for="college">College Name</label>
          </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>
      </div>
    </form>
  </div>
  </body>
</html>
