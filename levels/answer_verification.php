<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['username']) && !empty($_POST['answer'])) {
        $db = new DBHelper();
        $con = $db->getConnection();

        $answer = test_input(filter_input(INPUT_POST, 'answer'));
        $answer = $con->real_escape_string($answer);

        //fetch actual answer to verify
        $question_no = $_SESSION['current_level'];
        $query = "SELECT * FROM questions WHERE question_no='$question_no'";
        $res = $con->query($query);
        $r = $res->fetch_assoc();
        $actual_answer = $r['answer'];
        $points = $r['points'];
        $username = $_SESSION['username'];
        $query = "SELECT * FROM track_records WHERE username='$username'";
        $res = $con->query($query);
        $r = $res->fetch_assoc();
        $current_level = $r['current_level'];
        if ($actual_answer == $answer && $_SESSION['current_level'] == $current_level) {
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
                if ($_SESSION['current_level'] >= 17) {
                    date_add($date, date_interval_create_from_date_string("30 minutes"));
                } else {
                    date_add($date, date_interval_create_from_date_string("3 minutes 30 seconds"));
                }

                $date = date_format($date, "Y-m-d H:i:s");
                $when_to_unblock = $date;
                $_SESSION['when_to_unblock'] = $date;

                $query = "UPDATE track_records SET when_to_unblock='$when_to_unblock',on_block='$on_block' WHERE username='$username'";
                $res = $con->query($query);
                header("location:blocked.php");
            } else {
                header("location:" . $_SESSION['current_level'] . ".php");
            }

        } else {
            header("location:" . $_SESSION['current_level'] . ".php?a=f");
        }
    } else {
        header("location:" . $_SESSION['current_level'] . ".php");
    }
} else {
    header("location:" . $_SESSION['current_level'] . ".php");
}