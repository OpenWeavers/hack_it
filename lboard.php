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
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css" />
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <!--<link rel="stylesheet" href="css/materialize.css" >-->
        <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
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
      <nav>
        <div class="nav-wrapper">
          <a href="#!" class="brand-logo">&nbsp;hack_it</a>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
          <ul class="right hide-on-med-and-down">
            <li><a href="./index.php">Home</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="./about.html">About</a></li>
          </ul>
          <ul class="side-nav" id="mobile-demo">
            <li><a href="./index.php">Home</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="./about.html">About</a></li>
          </ul>
        </div>
    </nav>
    <div class="row" id="lbrd">
      <table class="highlight">
        <caption>LeaderBoard</caption>
        <tr>
          <th>Position</th>
          <th>username</th>
          <th>Points</th>
        </tr>
        <tr>
          <td>1</td>
          <td>uname1</td>
          <td>0.0</td>
        </tr>
      </table>
    </div>
  </body>
</html>