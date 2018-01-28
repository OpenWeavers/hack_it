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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script src="../js/flipclock.js"></script>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="#!" class="brand-logo">&nbsp;&nbsp;hack_it</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.html">About</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.html">About</a></li>
        </ul>
    </div>
</nav>
<div class="row">
    <div id="wait">
        As you have used a hint, please wait for:<br><br><br><br><span class="clock"></span><br><br><br><br>
        <a href="blocked.php"> Click here</a> to Refresh
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
