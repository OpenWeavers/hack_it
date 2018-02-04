<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sign Up Successful</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <link rel="manifest" href="site.webmanifest">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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

        html {
            background-color: #28505D;
        }

        .planePath {
            stroke: #D9DADA;
            stroke-width: .1%;
            stroke-width: .5%;
            stroke-dasharray: 1% 2%;
            stroke-linecap: round;
            fill: none;
        }

        .fil1 {
            fill: #D9DADA;
        }

        .fil2 {
            fill: #C5C6C6;
        }

        .fil4 {
            fill: #9D9E9E;
        }

        .fil3 {
            fill: #AEAFB0;
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
        <h3 class="header1">Sign-up was successful.<br>Check your mail for account activation link.<br>It may take upto 5 minutes to recieve email.</h3>
        <a href="login.php" class="btn" type="button">Login</a>
    </div>

</div>
<div>
    <svg viewBox="0 0 3387 1270">
        <path id="planePath" class="planePath" d="M-226 626c439,4 636,-213 934,-225 755,-31 602,769 1334,658 562,-86 668,-698 266,-908 -401,-210 -893,189 -632,630 260,441 747,121 1051,91 360,-36 889,179 889,179" />
        <g id="plane">
            <polygon class="fil1" points="-141,-10 199,0 -198,-72 -188,-61 -171,-57 -184,-57 " />
            <polygon class="fil2" points="199,0 -141,-10 -163,63 -123,9 " />
            <polygon class="fil3" points="-95,39 -113,32 -123,9 -163,63 -105,53 -108,45 -87,48 -90,45 -103,41 -94,41 " />
            <path class="fil4" d="M-87 48l-21 -3 3 8 19 -4 -1 -1zm-26 -16l18 7 -2 -1 32 -7 -29 1 11 -4 -24 -1 -16 -18 10 23zm10 9l13 4 -4 -4 -9 0z" />
            <polygon class="fil1" points="-83,28 -94,32 -65,31 -97,38 -86,49 -67,70 199,0 -123,9 -107,27 " />
        </g>
        <!-- Define the motion path animation -->
        <animateMotion xlink:href="#plane" dur="5s" repeatCount="indefinite" rotate="auto">
            <mpath xlink:href="#planePath" />
        </animateMotion>
    </svg>
</div>


</body>
<footer class="footernobg footer-copyright"><div></div><div><p>© 2018 Made by&nbsp; <a href="https://github.com/OpenWeavers" target="_blank"><img src="img/OpenWeavers-01.png" alt="OpenWeavers" width="30" height="30"></a></p></div></footer>

</html>