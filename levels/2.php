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
    <title>hack_it</title>
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
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();

            $("#hntbtn").click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "get_hint.php",
                    data: {},
                    success: function (result) {
                        //alert('ok:' + result);
                        var $toastContent = '<span style="word-wrap: break-word">' + result + '</span><button class="btn-flat toast-action" onclick="dismissToast()">Dismiss</button>';
                        Materialize.toast($toastContent, 100000);
                    },
                    error: function (result) {
                        //alert('error');
                    }
                });
            });
        });

        function dismissToast() {
            Materialize.Toast.removeAll();
        }

    </script>

</head>
<body>

<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<nav>
    <div class="nav-wrapper">
        <a href="../index.php" class="brand-logo">&nbsp;&nbsp;&nbsp;&nbsp;hack_it</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="">Level : <?php echo $_SESSION['current_level'] ?></a></li>
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li class="userView email"><a href=""><?php echo $_SESSION['username'];?></a> </li>
            <li><a href="">Level : <?php echo $_SESSION['current_level'] ?></a></li>
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>

        </ul>
    </div>
</nav>

<div class="row" id="ques">
    <form class="col m6 s12" action="answer_verification.php" method="post">

        <div class="row">
            <script type="text/javascript" language="javascript">
                $('.myIframe').css('height', $(window).height() * .5 + 'px');
            </script>
            <div class="input-field col s12">
                <input name="answer" id="input1" class="input-field inline" type="text">
                <br/>
                <label for="input1">Answer</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>
        &nbsp;&nbsp;
        <br>
        <br>
        <button class="btn waves-effect waves-light" id="hntbtn">Hint ?</button>
        <div class="col s12">
        <span class="error"><?php if (isset($_GET['a']) && test_input($_GET['a']) == 'f') {
                echo "Answer is incorrect. Try again!";
            } ?></span></div>
    </form>
</div>
</body>
</html>
