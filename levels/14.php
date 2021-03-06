<?php
require '../com/config/DBHelper.php';
session_start();
$level = basename($_SERVER['SCRIPT_FILENAME'], ".php");
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}
if (isset($_SESSION['username']) && $_SESSION['current_level'] != $level) {
    header("location:" . $_SESSION['current_level'] . ".php");
}
if (isset($_SESSION['username']) && $_SESSION['on_block'] == $level) {
    $now = date('Y-m-d H:i:s');
    $time_to_unblock = date($_SESSION['when_to_unblock']);
    if ($time_to_unblock <= $now) {
        $db = new DBHelper();
        $con = $db->getConnection();
        $username = $_SESSION['username'];
        $query = "UPDATE track_records SET on_block=0 WHERE username='$username'";
        $con->query($query);
        $_SESSION['on_block'] = 0;
    } else {
        header("location:blocked.php");
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="../site.webmanifest">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--<link rel="stylesheet" href="../css/materialize.css" >-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .toast {
            width: 50%;
            border-radius: 0;
        }

        #toast-container {
            min-width: 100%;
            bottom: 70%;
            top: 0%;
            right: 0%;
            left: 25%;
        }

        #ques {
            padding: 1% 5%;
            font-size: 120%;
            color: #222;
        }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });

    </script>

</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->
<!-- Always shows a header, even in smaller screens. -->
<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Hack_It</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.html">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.html">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </div>
</nav>
<div class="row" id="ques">
    <form class="col s6" action="answer_verification.php" method="post">

        <div class="row">
            <!--Put Question Content Here!-->
            <h6>Give the domain name of the following </h6>
            &nbsp;&nbsp;
            <div style="padding-bottom: 20px;">
                <img style="border-radius: 5%" src="qres/windows8.jpg" height="112" width="200">
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <img style="border-radius: 5%" src="qres/epen.jpg" height="100" width="100">
            </div>
            <div style="padding-bottom: 10px">
                <img style="border-radius: 5%" src="qres/emon.jpg" height="112" width="200">
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;
                <img style="border-radius: 5%" src="qres/emouse.jpg" height="150" width="200">
            </div>
            <div class="input-field col s12">
                <input name="answer" id="input1" class="input-field inline" type="text">
                <br/>
                <label for="input1">Answer</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>
</body>
</html>
