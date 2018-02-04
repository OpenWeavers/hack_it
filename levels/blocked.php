<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}
if (isset($_SESSION['username'])) {
    if ($_SESSION['on_block'] == 0) {
        header("location:" . $_SESSION['current_level'] . ".php");
    } else {
        $now = date_create('now');
        $time_to_unblock = date_create($_SESSION['when_to_unblock']);
        $diff = $time_to_unblock->getTimestamp() - $now->getTimestamp();
        if ($time_to_unblock <= $now) {
            $db = new DBHelper();
            $con = $db->getConnection();
            $username = $_SESSION['username'];
            $query = "UPDATE track_records SET on_block=0 WHERE username='$username'";
            $con->query($query);
            $_SESSION['on_block'] = 0;
        }
    }
}
?>

<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Wait</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="../site.webmanifest">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <link rel="stylesheet" href="../css/flipclock.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--<link rel="stylesheet" href="css/materialize.css" >-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        #lnk {
            color: #ffffff;
        }

        .clock {
            zoom: 0.7;
            -moz-transform: scale(0.7);
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../js/flipclock.js"></script>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });

    </script>
</head>
<body>
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
            <li><a href="">Level : <?php echo $_SESSION['current_level'] ?></a></li>
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </div>
</nav>
<div class="row center-align">
    <div class="col s12 m6 offset-m3 center-align">
        <div class="card teal z-depth-3 center-align">
            <div class="card-content white-text center">
                <span class="card-title">As you have used a hint, please wait for:</span>
                <div id="wait">
                    <span class="clock"></span>
                </div>
            </div>
            <div class="card-action center-align teal lighten-1">
                <a href="blocked.php" id="lnk">Refresh</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var diff = '<?php echo $diff; ?>';
        if (diff > 0) {
            // Instantiate a coutdown FlipClock
            var clock = $('.clock').FlipClock(diff, {
                clockFace: 'MinuteCounter',
                countdown: true,
                stop: function () {
                    $("#wait").hide();
                    window.location.href = "<?php echo $_SESSION['current_level'] . ".php" ?>";
                }
            });
        }
        else {
            window.location.href = "<?php echo $_SESSION['current_level'] . ".php" ?>";

        }
    });
</script>

</body>
</html>
