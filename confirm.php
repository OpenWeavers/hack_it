<?php
    require 'variables.php';
    require 'com/config/DBHelper.php';

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //m->mode(r->reset, c->confirm)
    //u->username
    //h->hash

    $mode = test_input($_GET['m']);
    $username = test_input($_GET['u']);
    $hash = test_input($_GET['h']);

    $db = new DBHelper();
    $conn = $db->getConnection();

    $q1 = "SELECT hash FROM `users` WHERE username='$username'";
    $result = $conn->query($q1);
    //print_r($result);
    $r = $result->fetch_assoc();
    //print_r($r);

    if($result->num_rows == 1 and $r['hash'] == $hash) {
        if($mode == 'c') {
            $q2 = "UPDATE `users` SET activated=1 WHERE username=$username";
            if ($conn->query($q2) == false) {
                //die($conn->connect_error);
                die("Error occured while confirming link.<br>Try Again.");
            } else {
                echo "Account confirmation successful.<br>Login and get cracking!.<br>";
                echo '<a href="login.php"><b>Login</b></a>';
            }
        }
        else if($mode == 'r') {
            $q2 = "UPDATE `users` SET password=temp_pwd WHERE username=$username";
            if ($conn->query($q2) == false) {
                //die($conn->connect_error);
                die("Error occured while resetting password.<br>Try Again.");
            } else {
                echo "Password reset successful.<br>Login with your new credentials.<br>";
                echo '<a href="login.php"><b>Login</b></a>';
            }
        }
        else {
            echo "Invalid link.<br>";
            echo "You are encouraged to test your hacking skills on our questions, not here.<br>";
            echo "Thank You!<br>";
        }
    }
    else {
        echo "Invalid link.<br>";
        echo "You are encouraged to test your hacking skills on our questions, not here.<br>";
        echo "Thank You!<br>";
    }
?>