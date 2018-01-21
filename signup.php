<?php
require 'mailer.php';
require 'com/config/DBHelper.php';
session_start();
if (isset($_SESSION['username'])) {
    header("location:/" . $_SESSION['current_level'] . "php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['college'])) {
        $db = new DBHelper();
        $con = $db->getConnection();
        $error_flag = false;

        $username = test_input(filter_input(INPUT_POST, 'username'));
        $password = test_input(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = test_input(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $phone = test_input(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT));
        $college = test_input(filter_input(INPUT_POST, 'college', FILTER_SANITIZE_STRING));

        $username = $con->real_escape_string($username);
        $password = $con->real_escape_string($password);
        $email = $con->real_escape_string($email);
        $phone = $con->real_escape_string($phone);
        $college = $con->real_escape_string($college);

        $password = hash("sha512", $password);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            $error_flag = true;
        } else {
            $query = "SELECT email FROM users WHERE email='$email'";
            $res = $con->query($query);
            $r = $res->fetch_assoc();
            if (!empty($r['email']) && $r['email'] == $email) {
                $emailError = "Email is already registered.";
                $error_flag = true;
            }
        }

        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $username)) {
            $usernameError = "Only letters, white space and numbers allowed in username";
            $error_flag = true;
        } else {
            $query = "SELECT username FROM users WHERE username='$username'";
            $res = $con->query($query);
            $r = $res->fetch_assoc();
            if (!empty($r['username']) && $r['username'] == $username) {
                $usernameError = "Username already in use.";
                $error_flag = true;
            }
        }

        if (!preg_match("/^[0-9]*$/", $phone)) {
            $phoneError = "Enter valid phone number";
            $error_flag = true;
        }

        if (!preg_match("/^[a-zA-Z ]*$/", $college)) {
            $collegeError = "Only letters and white space allowed";
            $error_flag = true;
        }

        if ($error_flag == false) {
            //register if no error
            $confirmation_code = hash("sha512", uniqid(rand()));
            if (!empty($username) && !empty($email) && !empty($password) && !empty($phone) && !empty($college)) {
                $hash = uniqid(rand());
                $query = "INSERT INTO users(username,email,password,phone,college,hash) VALUES ('$username','$email','$password','$phone','$college','$hash')";
                $res = $con->query($query);
                if ($res) {
                    try {
                        //Recipients
                        $mail->setFrom('open.weavers@linuxmail.org', 'hack_it, LCC SJCE');
                        $mail->addAddress($email);               // Name is optional

                        //Content
                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'Account Confirmation Link';
                        $mail->Body = 'Click on this <a href="' . $root_path . 'confirm.php?m=c&u=' . $username . '&h=' . $hash . '"><b>link</b></a>
                                  to confirm password change';
                        $mail->AltBody = 'A Password recovery attempt was made on your account.Click on this link to confirm 
                              password change in a HTML-enabled mail service';

                        $mail->send();
                    } catch (Exception $e) {
                        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                    }
                }
            } else {
                $error = "Enter all fields";
            }
        }

    }
}

?>

//HTML goes here
