<?php
require '../com/config/DBHelper.php';
session_start();
$level = basename($_SERVER['SCRIPT_FILENAME'], ".php");
function ascii_sum($str){
  $sum = 0;
  $arr1 = str_split($str);
  foreach ($arr1 as $item) {
    $sum += ord($item);
  }
  return $sum;
}

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
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="../site.webmanifest">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="../css/main.css">

    <style>
        .toast {
            width: 50%;
            border-radius: 0;
        }

        #toast-container {
            min-width: 100%;
            bottom: 0%;
            top: 70%;
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
                        var $toastContent = '<span style="word-wrap: break-word">' + result + '</span><button class="btn-flat toast-action" onclick="dismissToast()">Dismiss</button>';
                        Materialize.toast($toastContent, 100000);
                    },
                    error: function (result) {
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
            <li class="userView name"><a href=""><?php echo $_SESSION['username'];?></a> </li>
            <li><a href="">Level : <?php echo $_SESSION['current_level'] ?></a></li>
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
    </div>
</nav>
<?php
      $username = $_SESSION['username'];
      $actual_answer = $username."__GETs_it_".ascii_sum($username);
      if(isset($_GET['key1']) && isset($_GET['key2']) && isset($_GET['key3']) && isset($_GET['key4'])) {
          if($_GET['key1']=='0' && $_GET['key2']=='1' && $_GET['key3']=='1' && $_GET['key4']=='0') {
            //Please fix toast here, I'm struggling
            echo "<script>Materialize.toast(\"<span style=\'word-wrap: break-word\'>Password: ".$actual_answer."</span><button class=\'btn-flat toast-action\' onclick=\'dismissToast()\'>Dismiss</button>\",100000)</script>";
        }
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST')   {
          if (!empty($_POST['answer']))   {
              $db = new DBHelper();
              $con = $db->getConnection();

              $answer = test_input(filter_input(INPUT_POST, 'answer'));
              $answer = $con->real_escape_string($answer);

              //fetch actual answer to verify
              $question_no = $_SESSION['current_level'];
              //$query = "SELECT * FROM questions WHERE question_no='$question_no'";
              //$res = $con->query($query);
              //$r = $res->fetch_assoc();
              $points = 10;
              $query = "SELECT * FROM track_records WHERE username='$username'";
              $res = $con->query($query);
              $r = $res->fetch_assoc();
              $current_level = $r['current_level'];
      $actual_answer = $username."__GETs_it_".ascii_sum($username);
              if ($actual_answer == $answer && $_SESSION['current_level'] == $current_level)   {
                  //Right answer!
                  $current_hint_took = $r['current_hint_took'];
                  $total_score = $r['total_score'];
                  $total_score = $total_score + $points;

                  $current_level = $current_level + 1;
                  $last_success = date('Y-m-d H:i:s');
                  //Reflect in DB
                  $query = "UPDATE track_records SET total_score='$total_score',current_level='$current_level',current_hint_took=0,last_success='$last_success' WHERE username='$username'";
                  $con->query($query);

                  //Now handle session variables!
                  $_SESSION['current_level'] = $current_level;
                  $_SESSION['total_score'] = $total_score;
                  $_SESSION['current_hint_took'] = 0;
                  if ($current_hint_took == 1) {
                      //redirect to wait page
                      $on_block = $current_level;
                      $_SESSION['on_block'] = $on_block;
                      $date = date_create("now");
                      date_add($date, date_interval_create_from_date_string("30 minutes"));
                      $date = date_format($date, "Y-m-d H:i:s");
                      $when_to_unblock = $date;
                      $_SESSION['when_to_unblock'] = $date;

                      $query = "UPDATE track_records SET when_to_unblock='$when_to_unblock',on_block='$on_block' WHERE username='$username'";
                      $res = $con->query($query);
                      header("location:blocked.php");
                  }
                  else {
                      header("location:" . $_SESSION['current_level'] . ".php");
                  }

              }
              else    {
                  header("location:".$_SESSION['current_level'].".php");
              }
          }
          else    {
              header("location:".$_SESSION['current_level'].".php");
          }
      } ?>
<div class="row" id="ques">
    <form class="col s6" action="17.php" method="post">
      
      <div>
        <div class="row">
          <!--Please fix here dear sandwiches-->
            <div class="card-panel">
                  <p class="flow-text" style="font-size:20px"> Bertram Gilfoyle likes to GET his password though 4 keys key1, key2, key3 and key4 which are Xclusively ORdered </p>
            </div>
        </div>
        <div class="row">
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
        <div class="col s12">
        <span class="error"><?php if (isset($_GET['a']) && ($_GET['a']) == 'f') {
                echo "Answer is incorrect. Try again!";
            } ?></span></div>
    </form>
</div>
</body>
</html>

