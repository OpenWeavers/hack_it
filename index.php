<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--<link rel="stylesheet" href="css/materialize.css" >-->
    <link rel="stylesheet" href="css/main.css">
    <style>
        .demo-card-wide.mdl-card {
            max-width: 512px;
            width: 80%;
        }

        .demo-card-wide > .mdl-card__title {
            color: #fff;
            height: 176px;
            background: url('./img/hacking-icon-clipart-png-21.png') center / cover;
        }

        .demo-card-wide > .mdl-card__menu {
            color: #fff;
        }

        .mdl-card__supporting-text {
            font-size: 15px;
        }

        /* DEMO-SPECIFIC STYLES */
        .typewriter h5 {
            color: #000000;
            font-family: monospace;
            overflow: hidden; /* Ensures the content is not revealed until the animation */
            border-right: .1em solid lightseagreen; /* The typwriter cursor */
            white-space: nowrap; /* Keeps the content on a single line */
            margin: 0 auto; /* Gives that scrolling effect as the typing happens */
            letter-spacing: 1px; /* Adjust as needed */
            animation:
                    typing 4.5s steps(50, end),
                    blink-caret .5s step-end infinite;
        }

        /* The typing effect */
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }

        /* The typewriter cursor effect */
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: lightseagreen }
        }

        #limit {
            max-width: 30%;
        }
    </style>
</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">hack_it</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="./lboard.php">Leader Board</a>
                <a class="mdl-navigation__link" href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a>
                <a class="mdl-navigation__link" href="about.php">About</a>
            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer" style="background: white">
        <span class="mdl-layout-title" style="color: #009688">Welcome!</span>
        <nav class="mdl-navigation" style="background-color: white">
            <a class="mdl-navigation__link " href="./login.php">Sign In</a>
            <a class="mdl-navigation__link" href="./lboard.php">Leader Board</a>
            <a class="mdl-navigation__link" href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a>
            <a class="mdl-navigation__link" href="about.php">About</a>

        </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">
            &nbsp;&nbsp;
            <div class="row" align="center">
                <!-- Wide card with share menu button -->
                <div class="demo-card-wide mdl-card mdl-cell mdl-cell--12-col mdl-cell--4-col-tablet mdl-shadow--2dp col s6 m6"
                     style="position: relative;">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text" style="color: black" align="left">Welcome</h2>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="signup.php">
                            Sign Up
                        </a>
                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="./login.php">
                            Sign In
                        </a>
                    </div>
                </div>
            </div>
            <div class="typewriter">
                <h5 id="limit">Congregate.Create.Contribute.</h5>
            </div>
        </div>
    </main>
</div>
</body>
</html>
