<html>
<body>

<?php

require 'mailer.php';

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'variables.php';
  require 'com/config/DBHelper.php';

  $email = test_input($_POST['email']);
  $password = test_input($_POST['password']);

  $q1 = "SELECT * FROM `users` WHERE email='$email'";

    $db = new DBHelper();
    $conn = $db->getConnection();
    $result = $conn->query($q1);
    //or die($conn->error);
    //print_r($result);
    $r = $result->fetch_assoc();

    $hash = uniqid(rand());

    if ($result->num_rows > 0) {

        $q2 = "UPDATE `users` SET temp_pwd='$password', hash='$hash' WHERE email='$email'";
        if($conn->query($q2) == false) {
            //die($conn->connect_error);
            die("Error occured while sending link to Email");
        }

        // email id found
        try {

            //Recipients
            $mail->setFrom('open.weavers@linuxmail.org', 'hack_it, LCC SJCE');
            $mail->addAddress($r['email']);               // Name is optional

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset Confirmation Link';
            $mail->Body    = 'A Password recovery attempt was made on your account.<br>
                              Click on this <a href="'.$root_path.'confirm.php?m=r&u='.$r['username'].'&h='.$hash.'"><b>link</b></a>
                              to confirm password change';
            $mail->AltBody = 'A Password recovery attempt was made on your account.Click on this link to confirm 
                              password change in a HTML-enabled mail service';

            $mail->send();
            echo 'Message has been sent.<br>';
            echo 'Access your mail to confirm Password Reset.<br>';
            echo '<a href="'.$root_path.'"><b>Go Back</b></a>';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

    } else {
        echo "<p>Email-ID not found. Try Again.</p>";
    }
}
else {
    echo '
    <h3 > Enter Email - ID for which password reset is required:</h3 >
    <form action = "'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method = "post" >
        <input id = "email" name = "email" type = "email" placeholder = "Email-ID" required ><br >
        <input id = "password" name = "password" type = "password" placeholder = "Password" required ><br >
        <button type = "submit" > Reset Password </button >
    </form >';
}

echo '
</body >
</html>';
 ?>
