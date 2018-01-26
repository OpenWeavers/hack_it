<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}

if($_SERVER['REQUEST_METHOD'] == 'POST')    {
    $db = new DBHelper();
    $con = $db->getConnection();
    $username = $_SESSION['username'];
    $hint = '';
    $query = "SELECT current_level,current_hint_took FROM track_records WHERE username='$username'";
    $res = $con->query($query);
    if ($r = $res->fetch_assoc())    {
        $current_level = $r['current_level'];
        $hint_took = $r['current_hint_took'];
        $_SESSION['current_hint_took'] = $hint_took;

        if($_SESSION['current_level'] == $current_level)    {
            $query = "SELECT hint FROM questions WHERE question_no='$current_level'";
            $res = $con->query($query);
            if($r = $res->fetch_assoc())    {
                $hint = $r['hint'];
            }

            if ($hint_took == 0)    {
                $hint_took = 1;
                $_SESSION['current_hint_took'] = $hint_took;
                $on_block = $current_level + 1;
                $_SESSION['on_block'] = $on_block;
                $date = new DateTime("now");
                $date->modify("+10 minutes");
                $date->format("Y-m-d H:i:s");
                $when_to_unblock = $date;
                $_SESSION['when_to_unblock'] = $date;

                $query = "UPDATE track_records SET when_to_unblock='$when_to_unblock',on_block='$on_block',current_hint_took='$hint_took' WHERE username='$username'";
                $res = $con->query($query);
                echo $hint;
            }
        }

    }

}