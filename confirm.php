
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Confirmation</title>
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

        .header1{
            color: #ffffff;

        }

        .btn{
            background-color: black;
        }
        .btn:visited{
            background-color: #000000
        }
        .btn:hover {
            background-color: #eb8e3f
        }
        .btn:focus{
            background-color: gray;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });

    </script>

</head>
<body style="background-color: #009688">
<div class="row">
    <div class="col m6 s12">
        <?php
        require 'variables.php';
        require 'com/config/DBHelper.php';

        function test_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //m->mode(r->reset, c->confirm)
        //u->username
        //h->hash

        $mode = test_input($_GET['m']);
        $username = test_input($_GET['u']);
        $hash = test_input($_GET['h']);

        $db = new DBHelper();
        $conn = $db->getConnection();

        $q1 = "SELECT hash FROM `users` WHERE username='$username'";
        $result = $conn->query($q1);
        //print_r($result);
        $r = $result->fetch_assoc();
        //print_r($r);

        if ($result->num_rows == 1 and $r['hash'] == $hash) {
            if ($mode == 'c') {
                $q2 = "UPDATE `users` SET activated=1 WHERE username='$username'";
                if ($conn->query($q2) == false) {
                    //die($conn->connect_error);
                    die("<h3 class=\"header1\">Error occured while confirming link.<br>Try Again.</h3>");
                } else {
                    echo "<h3 class=\"header1\">Account confirmation successful.<br>Login and get cracking!.<br></h3>";
                    echo '<a href="login.php" class="btn" type="button">Login</a>';
                }
            } else if ($mode == 'r') {
                $q2 = "UPDATE `users` SET password=temp_pwd WHERE username='$username'";
                if ($conn->query($q2) == false) {
                    //die($conn->connect_error);
                    die("Error occured while resetting password.<br>Try Again.");
                } else {
                    echo "Password reset successful.<br>Login with your new credentials.<br>";
                    echo '<a href="login.php"><b>Login</b></a>';
                }
            } else {
                echo "<h3 class=\"header1\">Invalid link.<br></h3>";
                echo "<h3 class=\"header1\">You are encouraged to test your hacking skills on our questions, not here.<br></h3>";
                echo "<h3 class=\"header1\">Thank You!<br></h3>";
            }
        } else {
            echo "<h3 class=\"header1\">Invalid link.<br></h3>";
            echo "<h3 class=\"header1\">You are encouraged to test your hacking skills on our questions, not here.<br></h3>";
            echo "<h3 class=\"header1\">Thank You!<br></h3>";
        }
        ?>
    </div>
</div>

</body>
<footer class="footernobg footer-copyright"><div></div><div><p>© 2018 Made by&nbsp; <a href="https://github.com/OpenWeavers" target="_blank"><img src="img/OpenWeavers-01.png" alt="OpenWeavers" width="30" height="30"></a></p></div></footer>

</html>
