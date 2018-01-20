<?php
require 'com/config/DBHelper.php';
session_start();
if (isset($_SESSION['username'])) {
    header("location:/".$_SESSION['current_level']."php");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST['username']) && !empty($_POST['password']))    {
        $db = new DBHelper();
        $con = $db->getConnection();


        $username = test_input(filter_input(INPUT_POST, 'username'));
        $password = test_input(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
        $username = $con->real_escape_string($username);
        $password = $con->real_escape_string($password);

        $password = hash("sha512", $password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' and activated=1";
        $res = $con->query($query);
        $r = $res->fetch_assoc();
        if($res->num_rows == 1) {
            $_SESSION['username'] = $username;
            $query1 = "SELECT * FROM track_records WHERE username='$username'";
            $res1 = $con->query($query1);
            $r1 = $res1->fetch_assoc();
            if($res1->num_rows == 1) {
                $_SESSION['current_level'] = $r1['current_level'];
                $_SESSION['total_score'] = $r1['total_score'];
                $_SESSION['current_hint_took'] = $r1['current_hint_took'];
                $_SESSION['on_block'] = $r1['on_block'];
                $_SESSION['when_to_unblock'] = $r1['when_to_unblock'];
            }
            header("levels/{$_SESSION['current_level']}");
        }

        //handle login error
    }
}

?>

//Login HTML here