<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username']))  {
    header("location:../index.php");
}

function get_hint() {
    if ($_SESSION['current_hint_took']) {
        $db = new DBHelper();
        $con = $db->getConnection();
        $query = "SELECT hint FROM questions WHERE question_no='{$_SESSION['current_level']}'";
        $res = $con->query($query);
        $r = $res->fetch_assoc();
        return $r['hint'];
    }
    return null;
}