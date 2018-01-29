<?php
require 'com/config/DBHelper.php';
session_start();
$db = new DBHelper();
$con = $db->getConnection();

$query = "SELECT username, total_score, current_level FROM `track_records` ORDER BY total_score DESC, last_success ASC";
$data = [];
if($res = $con->query( $query)) {
    $i = 0;
    while($row = $res->fetch_assoc())   {
        $data[$i]['username'] = $row['username'];
        $data[$i]['current_level'] = $row['current_level'];
        $data[$i]['total_score'] = $row['total_score'];
        $i++;
    }
}
?>

<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LeaderBoard</title>
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
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });

    </script>
</head>
<body>
<nav>
    <div class="nav-wrapper">
        <a href="index.php" class="brand-logo">&nbsp;hack_it</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <?php
            if(isset($_SESSION['username']))
                echo "<li><a href=\"levels/".$_SESSION['current_level'].".php\">Home</a></li>";
            else
                echo "<li><a href=\"./index.php\">Home</a></li>";
            ?>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="about.php">About</a></li>
            <?php
            if (isset($_SESSION['username']))
                echo "<li><a href=\"logout.php\">Log Out</a></li>";
            else
                echo "<li><a href=\"login.php\">Log In</a></li>";
            ?>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <?php
            if(isset($_SESSION['username']))
                echo "<li><a href=\"levels/".$_SESSION['current_level'].".php\">Home</a></li>";
            else
                echo "<li><a href=\"./index.php\">Home</a></li>";
            ?>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="about.php">About</a></li>
            <?php
            if (isset($_SESSION['username']))
                echo "<li><a href=\"logout.php\">Log Out</a></li>";
            else
                echo "<li><a href=\"login.php\">Log In</a></li>";
            ?>
        </ul>
    </div>
</nav>
<div class="row" id="lbrd">
    <table class="striped">
        <caption>LeaderBoard</caption>
        <thead>
        <tr>
            <th>Position</th>
            <th>Username</th>
            <th>Level</th>
            <th>Score</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for($i=0;$i<sizeof($data);$i++) {
            echo "<tr>";
            echo "<td>".($i+1)."</td>";
            echo "<td>".$data[$i]['username']."</td>";
            echo "<td>".$data[$i]['current_level']."</td>";
            echo "<td>".$data[$i]['total_score']."</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
