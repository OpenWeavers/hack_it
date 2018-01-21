<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username']))  {
    header("location:../index.php");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')   {
    if (!empty($_POST['answer']))   {
        $db = new DBHelper();
        $con = $db->getConnection();

        $answer = test_input(filter_input(INPUT_POST, 'answer'));
        $answer = $con->real_escape_string($answer);

        //fetch actual answer to verify
        $query = "SELECT * FROM questions WHERE question_no='{$_SESSION['current_level']}'";
        $res = $con->query($query);
        $r = $res->fetch_assoc();
        $actual_answer = $r['answer'];
        $points = $r['points'];
        $query = "SELECT * FROM track_records WHERE username={$_SESSION['username']}";
        $res = $con->query($query);
        $r = $res->fetch_assoc();
        $current_level = $r['current_level'];
        if ($actual_answer == $answer && $_SESSION['current_level'] == $current_level)   {
            //Right answer!
            $current_hint_took = $r['current_hint_took'];
            $total_score = $r['total_score'];
            $total_score = $total_score + $points;
            if ($current_hint_took == 1)  {
                $total_score = $total_score - 5; // assuming 5 is hint penalty
            }
            $current_level = $current_level + 1;
            //Reflect in DB
            $query = "UPDATE track_records SET total_score='$total_score',current_level='$current_level',current_hint_took=0";
            $con->query($query);

            //Now handle session variables!
            $_SESSION['current_level'] = $current_level;
            $_SESSION['total_score'] = $total_score;
            $_SESSION['current_hint_took'] = 0;

            header("location:".$_SESSION['current_level']."php");
        }
        else    {
            echo "Don't try to be smart!";
        }
    }
    else    {
        echo "Empty answer";
    }
}
else    {
    header("location:" . $_SESSION['current_level'] . "php");
}