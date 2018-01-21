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
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css" />
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <!--<link rel="stylesheet" href="css/materialize.css" >-->
        <link rel="stylesheet" href="css/main.css">
        <style>
            .demo-card-wide.mdl-card {
                width: 512px;
            }
            .demo-card-wide > .mdl-card__title {
                color: #fff;
                height: 176px;
                background: url('./img/hacking-icon-clipart-png-21.png') center / cover;
            }
            .demo-card-wide > .mdl-card__menu {
                color: #fff;
            }
        </style>
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <!-- Always shows a header, even in smaller screens. -->
        <?php
        include ("header.php");
        ?>

        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <main class="mdl-layout__content">
                <div class="page-content">
                    &nbsp;&nbsp;
                    <div class="row" align="center">
                        <!-- Wide card with share menu button -->
                        <div class="demo-card-wide mdl-card mdl-shadow--2dp col s6 m6" style="position: relative;">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text" style="color: black">Welcome</h2>
                            </div>
                            <div class="mdl-card__supporting-text">
                                An Online Event, that is as simple as just filling text in an Input Field, but involves a lot of tweaks and hacks of varying difficulty to get to the answer. The questions will be framed such that, the participants will gain good amount of basic hacking skills and also an exposure to places to get started with such stuff and also some cryptic puzzles.
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="signup.php">
                                    Sign Up
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
