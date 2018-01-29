<?php
session_start();
?>
<!doctype html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>About</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            $(document).ready(function(){
                $(".button-collapse").sideNav();
            });

        </script>
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
        <script>
        $(document).ready(function(){
          $(".button-collapse").sideNav();
        });

        </script>
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <!-- Always shows a header, even in smaller screens. -->
        <nav>
                      <div class="nav-wrapper">
                        <a href="index.php" class="brand-logo">&nbsp;&nbsp;&nbsp;&nbsp;hack_it</a>
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down">
                            <?php
                            if(isset($_SESSION['username']))
                                echo "<li><a href=\"levels/".$_SESSION['current_level'].".php\">Home</a></li>";
                            else
                                echo "<li><a href=\"./index.php\">Home</a></li>";
                            ?>
                          <li><a href="lboard.php">Leaderboard</a></li>
                          <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
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
                          <li><a href="lboard.php">Leaderboard</a></li>
                          <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
                            <?php
                            if (isset($_SESSION['username']))
                                echo "<li><a href=\"logout.php\">Log Out</a></li>";
                            else
                                echo "<li><a href=\"login.php\">Log In</a></li>";
                            ?>
                        </ul>
                      </div>
                  </nav>
        <h5>How To Play ?</h5>
        <h6><ol><li>Sign up using the link provided.</li>
        <li>A confirmation link will be sent to your mail. Use it to login.</li>
            <li>Log in and get cracking.</li>
            <li>Use any tool, ranging from your common-sense to Google, to arrive at the answer.</li>
            <li>Answers in lower case, with no space in between words.<br>
                For example, if answer is "LCC SJCE", you should type in "lccsjce"</li>
            <li>Every level contains a hint, but accessing it will cause a time-penalty of 10 minutes.<br>
                Once the hint is obtained, accessing it again won't cause any penalty.</li>
            <li>Position in leaderboard is decided on the user's score. If two or more users have the same score,<br>
                the tie-breaker is the time they took to reach that level.</li>
            <li>If stuck anywhere, ping us at the sub-reddit provided.</li>
        </ol></h6>
    <h6>Cheers.</h6>
    </body>
</html>
