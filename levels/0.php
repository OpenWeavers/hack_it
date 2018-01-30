<?php
require '../com/config/DBHelper.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}
if (isset($_SESSION['username']) && $_SESSION['current_level'] != 0) {
    header("location:" . $_SESSION['current_level'] . ".php");
}
$db = new DBHelper();
$con = $db->getConnection();
$query = "UPDATE track_records SET current_level=1 WHERE username='" . $_SESSION['username'] . "'";
$con->query($query);
$_SESSION['current_level'] = 1;
?>-
<html>
<head>
    <style>
        #login form {
            display: inline-block;
            position: fixed;
            left: 0;
            right: 0;
            margin: auto;
        }

        .error {
            color: red;
        }
        .header1{
            color: #ffffff;

        }
        .btn{
            background-color: black;
        }
        .btn:visited{
            background-color: #000000
        }
        .btn:hover {
            background-color: #eb8e3f
        }
        .btn:focus{
            background-color: gray;
        }

    </style>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome!</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="../site.webmanifest">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <!--<link rel="stylesheet" href="css/materialize.css" >-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });

    </script>

</head>
<body style="background-color: #009688">
<div class="row">
    <div class="col m6 s12">
        <h5 class="header1">How To Play?</h5>

            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">0. Use a Laptop!</span>
                            <p>Using laptop to perform hacks and tweaks is much easier than on phones.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">1. Sign Up</span>
                            <p>Sign up using the <a href="../signup.php">link</a> provided.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">2. Get Confirmed</span>
                            <p>A confirmation link will be sent to your mail. Use it to login.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">3. Login.</span>
                            <p>Log in and get cracking.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">4. Use Aids.</span>
                            <p>Use any tool, ranging from your common-sense to Google, to arrive at the answer.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">5. Answering Standards.</span>
                            <p>Answers in lower case, with no space in between words.
                                For example, if answer is "LCC SJCE", you should type in "lccsjce"</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">6. Use Hints Wisely.</span>
                            <p>Every level contains a hint, but accessing it will cause a time-penalty of 10 minutes.
                                Once the hint is obtained, accessing it again won't cause any penalty.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">7. Where You Stand.</span>
                            <p>Position in <a href="../lboard.php">leaderboard</a> is decided on the user's score. If two or more users have the same score,
                                the tie-breaker is the time they took to reach that level.</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m10">
                    <div class="card teal darken-2">
                        <div class="card-content white-text">
                            <span class="card-title">8. More Help?</span>
                            <p>If stuck anywhere, ping us at the <a href="https://www.reddit.com/r/hack_it/" target="_blank">sub-reddit</a> provided.</p>
                        </div>

                    </div>
                </div>
            </div>


        <div class="row">
            <div class="col m6 s12">
                <a href="1.php" class="btn" type="button">Begin Hack</a>
            </div>

        </div>

    </div>
</div>

</body>
</html>