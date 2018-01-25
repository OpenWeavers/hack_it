<?php
require 'mailer.php';
require 'com/config/DBHelper.php';
session_start();
if (isset($_SESSION['username'])) {
    header("location:levels/".$_SESSION['current_level'].".php");
}

function test_input($data)
{
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
        $e = 0;

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

        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
            $usernameError = "Only letters, white space and numbers allowed in username";
            $error_flag = true;
        } else {
            $query = "SELECT username FROM users WHERE username='$username'";
            $res = $con->query($query);
            $r = $res->fetch_assoc();
            if (!empty($r['username']) && $r['username'] == $username) {
                $usernameError = "Username already in use.";
                $error_flag = true;
                $e = 1;
            }
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            $error_flag = true;
        } else {
            $query = "SELECT email FROM users WHERE email='$email'";
            $res = $con->query($query);
            $r = $res->fetch_assoc();
            if (!empty($r['email']) && $r['email'] == $email) {
                $emailError = "Email is already registered.";
                $error_flag = true;
                $e = $e ? 3 : 2;
            }
        }

        if ($error_flag == false) {
            //register if no error
            //$confirmation_code = hash("sha512", uniqid(rand()));
            if (!empty($username) && !empty($email) && !empty($password) && !empty($phone) && !empty($college)) {
                require 'variables.php';
                $hash = uniqid(rand());
                try {
                    //Recipients
                    $mail->setFrom('open.weavers@linuxmail.org', 'hack_it, LCC SJCE');
                    $mail->addAddress($email);               // Name is optional

                    //Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Account Confirmation Link';
                    $mail->Body = 'Click on this <a href="' . $root_path . 'confirm.php?m=c&u=' . $username . '&h=' . $hash . '"><b>link</b></a>
                                 to activate your hack_it account.';
                    $mail->AltBody = 'A hack_it account was created using this email.Click on this link to confirm activation';

                    $mail->send();

                    $query = "INSERT INTO users(username,email,password,phone,college,hash) VALUES ('$username','$email','$password','$phone','$college','$hash')";
                    $res = $con->query($query);
                    if ($res) {
                        $date = date('Y-m-d H:i:s');

                        $query = "INSERT INTO track_records(username, current_level, total_score, current_hint_took, on_block, when_to_unblock) VALUES ('$username',0,0,0,0,'$date')";
                        $res = $con->query($query);
                        header("location:signup_success.php");
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }

            } else {
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
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--<link rel="stylesheet" href="css/materialize.css" >-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <style>
        #sgnupform form {
            display: inline-block;
            position: fixed;
            left: 0;
            right: 0;
            margin: auto;
        }

        .error {
            color: #ff0000;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });
    </script>
    <script>
        function validateForm() {
            console.log(1);
            var pat;
            var flag = true;

            x = document.getElementById("username").value;
            pat = /^[a-zA-Z0-9 ]{3,}$/;
            if (pat.test(x)) {
                document.getElementById('usernameE').innerHTML = '';
            }
            else {
                flag = false;
                document.getElementById('usernameE').innerHTML =
                    'Only alphabets, numbers and whitespaces allowed (Minimum: 3)';
            }

            x = document.getElementById("password").value;
            pat = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@!%*#?&])[A-Za-z\d$@!%*#?&]{8,}$/;
            if (pat.test(x)) {
                document.getElementById('passwordE').innerHTML = '';
            }
            else {
                flag = false;
                document.getElementById('passwordE').innerHTML =
                    'Minimum eight characters(at least one letter, one number and one special character)';
            }

            x = document.getElementById('phone').value;
            pat = /^\d{10}$/;
            if (pat.test(x)) {
                document.getElementById('phoneE').innerHTML = '';
            }
            else {
                flag = false;
                document.getElementById('phoneE').innerHTML =
                    'Only (ten) numbers allowed';
            }

            x = document.getElementById('email').value;
            pat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (pat.test(x)) {
                document.getElementById('emailE').innerHTML = '';
            }
            else {
                flag = false;
                document.getElementById('emailE').innerHTML =
                    'Invalid email format';
            }

            x = document.getElementById('college').value;
            pat = /^[a-zA-Z]{2,}$/;
            if (pat.test(x)) {
                document.getElementById('collegeE').innerHTML = '';
            }
            else {
                flag = false;
                document.getElementById('collegeE').innerHTML =
                    'Invalid college name';
            }

            return flag;

        }
    </script>

</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">hack_it</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="./about.html">About</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="./about.html">About</a></li>
        </ul>
    </div>
</nav>
&nbsp; &nbsp;
<div class="row" id="sgnupform">

    <form class="col s6" action="signup.php" onsubmit="return validateForm()" method="post">
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input name="username" id="username" type="text" class="validate"
                       value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $e != 1 && $e != 3) echo $_POST["username"]; ?>"
                       required>
                <span id="usernameE"
                      class="error"><?php if ($_SERVER["REQUEST_METHOD"] == "POST" && ($e == 1 || $e == 3)) {
                        echo "Username already exists. Try another one.";
                    } ?></span>
                <label for="icon_prefix">Username</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <input name="password" id="password" type="password" class="validate" required>
                <span id="passwordE" class="error"></span>
                <label for="password">Password</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">phone</i>
                <input name="phone" id="phone" type="tel" class="validate"
                       value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $_POST["phone"]; ?>" required>
                <span id="phoneE" class="error"></span>
                <label for="icon_telephone">Telephone</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <input name="email" id="email" type="email" class="validate"
                       value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST" && $e != 2 && $e != 3) echo $_POST["email"]; ?>"
                       required>
                <span id="emailE"
                      class="error"><?php if ($_SERVER["REQUEST_METHOD"] == "POST" && ($e == 2 || $e == 3)) {
                        echo "Email already exists. Try another one.";
                    } ?></span>
                <label for="email" data-error="wrong" data-success="right">Email</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">school</i>
                <input name="college" id="college" type="text" class="validate"
                       value="<?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $_POST["college"]; ?>" required>
                <span id="collegeE" class="error"></span>
                <label for="college">College Name</label>
            </div>
            <button class="btn waves-effect waves-light right" type="submit" name="action"><i
                        class="material-icons right">send</i>
                Submit
            </button>
        </div>
    </form>
</div>
</body>
</html>
