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
$now = date('Y-m-d H:i:s');
$time_to_unblock = date($_SESSION['when_to_unblock']);
if ($_SESSION['on_block'] == $level) {
    if ($time_to_unblock < $now) {
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
            <div class="input-field col s12">
                <textarea name="answer" id="textarea1" class="materialize-textarea"></textarea>
                <label for="textarea1">Answer</label>
            </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>
</body>
</html>
