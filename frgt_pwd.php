<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Reset Password</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--<link rel="stylesheet" href="css/materialize.css" >-->
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <style>
        #login form {
            display: inline-block;
            position: fixed;
            left: 0;
            right: 0;
            margin: auto;
        }

        .error {
            color: red;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });

    </script>
</head>

<body>
<script>
    function check() {
        var x = document.getElementById('password1').value;
        var y = document.getElementById('password2').value;

        pat = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@!%*#?&])[A-Za-z\d$@!%*#?&]{8,}$/;
        if (!pat.test(x)) {
            document.getElementById('passwordE').innerHTML =
                'Password must be atleast minimum eight characters(at least one letter, one number and one special character)';
            return false;
        }

        if (x === y) {
            document.getElementById('passwordE').innerHTML = "";
            return true;
        }
        else {
            document.getElementById('passwordE').innerHTML = "";
            document.getElementById('passwordE').innerHTML = "Passwords do not match.<br>Try Again!";
            return false;
        }
    }
</script>
<?php

require 'mailer.php';

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'variables.php';
    require 'com/config/DBHelper.php';

    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $password = hash("sha512", $password);

    $q1 = "SELECT * FROM `users` WHERE email='$email'";

    $db = new DBHelper();
    $conn = $db->getConnection();
    $result = $conn->query($q1);
    //or die($conn->error);
    //print_r($result);
    $r = $result->fetch_assoc();

    $hash = uniqid(rand());

    if ($result->num_rows > 0) {

        $q2 = "UPDATE `users` SET temp_pwd='$password', hash='$hash' WHERE email='$email'";
        if ($conn->query($q2) == false) {
            //die($conn->connect_error);
            die("Error occured while sending link to Email");
        }

        // email id found
        try {

            //Recipients
            //$mail->setFrom('openweavers@gmail.com', 'hack_it, LCC SJCE');
            //$mail->addAddress($r['email']);               // Name is optional

            //Content
            //$mail->isHTML(true);                                  // Set email format to HTML
            //$mail->Subject = 'Password Reset Confirmation Link';
            //$mail->Body = 'A Password recovery attempt was made on your account.<br>
              //                Click on this <a href="' . $root_path . 'confirm.php?m=r&u=' . $r['username'] . '&h=' . $hash . '"><b>link</b></a>
                //              to confirm password change';
            //$mail->AltBody = 'A Password recovery attempt was made on your account.Click on this link to confirm
                  //            password change in a HTML-enabled mail service';

            //$mail->send();

            $to = $r['email'];
            $subject = 'Password Reset Confirmation Link';
            $body = 'A Password recovery attempt was made on your account.<br>
                              Click on this <a href="' . $root_path . 'confirm.php?m=r&u=' . $r['username'] . '&h=' . $hash . '"><b>link</b></a>
                              to confirm password change';
            mail($to, $subject, $body);

            echo 'Message has been sent.<br>';
            echo 'Access your mail to confirm Password Reset.<br>';
            echo '<a href="' . $root_path . '"><b>Go Back</b></a>';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    } else {
        echo "<p>Email-ID not found. Try Again.</p>";
    }
} else {
    echo '
    <div class="row card" id="login">
    
    <form class="col m6 s12" action = "' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method = "post" onsubmit="return check()">
        <div class="row">
        <div class="input-field col s12">
        <i class="material-icons prefix">email</i>
        <input id = "email" name = "email" type = "email" placeholder = "Email-ID" required ><br >
        </div>
        <div class="input-field col s12">
        <i class="material-icons prefix">vpn_key</i>
        <input id = "password1" name = "password" type = "password" placeholder = "New Password" required ><br>
        </div>
        <div class="input-field col s12">
        <i class="material-icons prefix">done_all</i>
        <input id = "password2" name = "password" type = "password" placeholder = "Confirm New Password" required ><br>
        </div>
        <div class="input-field col s12">
        <button type = "submit" class="btn" > Reset Password </button >
        </div>
        </div>
    </form >
    </div>
    <span class="error" id="passwordE"></span> ';
}

?>
</body>
</html>
