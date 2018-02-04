<?php
require '../com/config/DBHelper.php';
session_start();
$level = basename($_SERVER['SCRIPT_FILENAME'], ".php");
if ($_SESSION['current_level'] == $level - 1) {
    if (!isset($_SESSION['username'])) {
        header("location:../index.php");
    }
    if (isset($_SESSION['username']) && $_SESSION['current_level'] != $level - 1) {
        header("location:" . $_SESSION['current_level'] . ".php");
    }
    if (isset($_SESSION['username']) && $_SESSION['on_block'] == $level - 1) {
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

    $db = new DBHelper();
    $con = $db->getConnection();

    $question_no = $_SESSION['current_level'];
    $query = "SELECT * FROM questions WHERE question_no='$question_no'";
    $res = $con->query($query);
    $r = $res->fetch_assoc();
    $points = $r['points'];
    $username = $_SESSION['username'];
    $query = "SELECT * FROM track_records WHERE username='$username'";
    $res = $con->query($query);
    $r = $res->fetch_assoc();
    $current_level = $r['current_level'];
    if ($_SESSION['current_level'] == $current_level) {
        //Right answer!
        $current_hint_took = $r['current_hint_took'];
        $total_score = $r['total_score'];
        $total_score = $total_score + $points;

        $current_level = $current_level + 1;
        $last_success = date('Y-m-d H:i:s');
        //Reflect in DB
        $query = "UPDATE track_records SET total_score='$total_score',current_level='$current_level',current_hint_took=0,last_success='$last_success' WHERE username='$username'";
        $con->query($query);
print_r($r,$points);
        //Now handle session variables!
        $_SESSION['current_level'] = $current_level;
        $_SESSION['total_score'] = $total_score;
        $_SESSION['current_hint_took'] = 0;
        if ($current_hint_took == 1) {
            //redirect to wait page
            header("location:blocked.php");
        }
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
<!DOCTYPE html>
<html xmlns:left="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>Congrats!</title>
</head>
<body>
<h1 align="center">You have won!</h1>
<img src="https://media.giphy.com/media/RyXVu4ZW454IM/giphy.gif" alt="hackerman"
     style="position: absolute; left: 45%; top: 50%; margin-left: -285px; margin-top: -190px;" height="380" width="720">
<h3 style="position: absolute; left: 30%; top: 135%; margin-top: -290px;">No, seriously you have. Don't try to find any more levels</h3>
</body>
</html>
