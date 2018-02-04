<?php
require '../com/config/DBHelper.php';
session_start();
$level = basename($_SERVER['SCRIPT_FILENAME'], ".php");
if (!isset($_SESSION['username'])) {
    header("location:../index.php");
}
if (isset($_SESSION['username']) && $_SESSION['current_level'] != $level) {
    header("location:" . $_SESSION['current_level'] . ".php");
}
if (isset($_SESSION['username']) && $_SESSION['on_block'] == $level) {
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
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="../site.webmanifest">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-amber.min.css"/>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <!--<link rel="stylesheet" href="../css/materialize.css" >-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection"/>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        .toast {
            width: 50%;
            border-radius: 0;
        }

        #toast-container {
            min-width: 100%;
            bottom: 70%;
            top: 0%;
            right: 0%;
            left: 25%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#hntbtn").click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "get_hint.php",
                    data: {},
                    success: function (result) {
                        var $toastContent = '<span style="word-wrap: break-word">' + result + '</span><button class="btn-flat toast-action" onclick="dismissToast()">Dismiss</button>';
                        Materialize.toast($toastContent, 100000);
                    },
                    error: function (result) {
                    }
                });
            });
        });

        function dismissToast() {
            Materialize.Toast.removeAll();
        }

    </script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {

            var hub = window,
                gate = $(hub),
                cog = $('.reel'),
                niche = [0, 0, 0, 0, 0, 0],
                beat;

            pulseMuzzle();
            tallyCells();

            if (document.readyState == 'complete') interAction();
            else gate.one('load', interAction);

            $('#submit').click(() = > {
                alert(niche.join('')
        )
            ;
        })
            ;

            function interAction() {

                var heap = $('.quota'),
                    field = $('#input1'),
                    range = cog.height(),
                    ambit = heap.eq(0).find('div:first-child').height(),
                    yaw = 'mousemove.turf touchmove.turf',
                    hike = 'mouseup.limit touchend.limit',
                    veer = '-webkit-transform', warp = 'transform',
                    unit = 180 / Math.PI, radius = 1, mound = [];

                cog.each(function (order) {

                    var pinion = $(this).find('.quota'),
                        slot = pinion.children(), ken = {};

                    slot.each(function (i) {

                        var aspect = Number(niche[order]) % 10 || 0;

                        orbitSpin(this, (i + aspect) * 36 % 360, true);

                        if (!i && order == cog.length - 1) field.val(niche.join(''));

                        if (!order && i && i < 3) {
                            radius -= ambit * Math.sin(i * 36 / unit);
                            if (i == 2) {
                                var axis = {}, pivot = '0 50% ' + radius.toFixed(2) + 'px';
                                axis[veer + '-origin'] = axis[warp + '-origin'] = pivot;
                                heap.css(axis);
                            }
                        }
                    })
                        .on('mousedown touchstart', function (e) {

                            if (e.which && e.which != 1) return;

                            if (pinion.hasClass('rotate')) {
                                quietDown(pinion, slot, order);
                                return false;
                            }

                            ken = mound[order] = {};

                            tagPoints(cog[order], e, ken);

                            gate.on(yaw, function (e) {

                                stalkHeart(e, ken);
                            })
                                .on(yaw, $.restrain(40, function () {

                                    if (ken.lift) return;

                                    slot.each(function () {

                                        orbitSpin(this, ken);
                                    });

                                }, true)).on(hike, function () {

                                lotRelease(order);

                                if (ken.gyre) driftAudit(slot, ken);
                            });

                            return false;
                        });

                    $(this).on('wheel', function (e) {

                        e.originalEvent.deltaY < 0 ? ken.gyre = 36 : ken.gyre = -36;

                        return false;
                    })
                        .on('wheel', $.restrain(40, function () {

                            if (pinion.hasClass('rotate') && !pinion.hasClass('device')) return false;

                            pinion.addClass('device');
                            revolveWheel(slot, '250ms', ken);
                        }));
                });

                heap.on(beat, function () {

                    var item = $(this);

                    if (item.hasClass('settle')) item.removeClass('settle rotate');
                    else if (item.hasClass('rotate')) assayFlow(this);
                    else return;

                    field.val(niche.join(''));
                });

                function tagPoints(motif, task, bin) {

                    var nod = task.originalEvent.touches,
                        weigh = setDigit($(motif).offset().top);

                    bin.rise = nod ? nod[0].pageY : task.pageY;
                    bin.mark = bin.rise - weigh;

                    isCue(bin);
                }

                function stalkHeart(act, jar) {

                    var peg = act.originalEvent.touches,
                        aim = peg ? peg[0].pageY : act.pageY,
                        ilk = aim - jar.rise,
                        due = Date.now(),
                        base = Object.keys(jar.cast).length;

                    jar.cap = Math.max(-jar.mark, Math.min(ilk, range - jar.mark));
                    jar.gyre = setDigit(nookRatio(jar.cap));
                    jar.cast[jar.poll] = [ilk, due];

                    if (base) {
                        var ante = jar.cast[(jar.poll + base - 1) % base];
                        if (due != ante[1]) {
                            jar.flux[jar.poll] = ilk - ante[0];
                            jar.urge[jar.poll] = due - ante[1];
                            jar.poll = (jar.poll + 1) % 10;
                        }
                    }
                    else jar.poll = (jar.poll + 1) % 10;

                    clearTimeout(jar.wipe);
                    jar.wipe = setTimeout(isCue, 80, jar);
                }

                function isCue(tub) {

                    tub.cast = {};
                    tub.flux = [];
                    tub.urge = [];
                    tub.poll = 0;
                }

                function orbitSpin(piece, bend, keep) {

                    var shim = $(piece), locus = shim.closest(cog).index(), mode = {};

                    if (!$.isNumeric(bend)) bend = shim.data('angle') + bend.gyre;
                    if (!bend || bend == 360) niche[locus] = shim.data('count');

                    mode[veer] = mode[warp] = 'rotateX(' + bend + 'deg)';

                    shim.css(mode);

                    if (keep) shim.data('angle', bend);
                }

                function quietDown(tooth, oriel, sign) {

                    if (tooth.hasClass('settle')) return;

                    assayFlow(tooth);

                    var edge = oriel.data('angle') % 36;

                    if (!edge) return;
                    else if (edge < 18) edge = -edge;
                    else edge = 36 - edge;

                    mound[sign].gyre = edge;
                    var tempo = 15 * Math.abs(edge) + 'ms';

                    setTimeout(revolveWheel, 0, oriel, tempo, mound[sign]);
                    tooth.addClass('settle');
                }

                function driftAudit(vent, bay) {

                    var rush = checkPace(vent, bay),
                        lean = bay.gyre,
                        tilt = Math.abs(lean % 36),
                        step = (lean - lean % 36) / 36;

                    if (rush) var speed = rush;
                    else {
                        if (tilt < 18) {
                            var notch = tilt;
                            bay.gyre = step * 36;
                        }
                        else {
                            notch = 36 - tilt;
                            if (lean > 0) bay.gyre = (step + 1) * 36;
                            else bay.gyre = (step - 1) * 36;
                        }
                        speed = Math.round(15 * notch);
                    }

                    revolveWheel(vent, speed + 'ms', bay);
                }

                function checkPace(realm, hod) {

                    if (hod.urge.length < 2) return;

                    var info = hod.urge;

                    if (!info[0]) {
                        hod.flux.shift();
                        info.shift();
                    }

                    var bulk = info.length, chunk = 0, whole = 0,

                        mean = 1 / bulk * info.reduce(function (total, cipher) {

                            return total + cipher;

                        }, 0),

                        quirk = Math.min(0.75 * mean, 1.5 / bulk * info.reduce(function (total, cipher) {

                            return total + Math.abs(cipher - mean);

                        }, 0));

                    $.each(info, function (i) {

                        if (this > mean + quirk || this < mean - quirk) return;

                        chunk += hod.flux[i];
                        whole += this;
                    });

                    mean = Math.abs(nookRatio(chunk) / whole);
                    var cusp = hod.gyre,
                        torque = (realm.data('angle') + cusp) % 36 - cusp;

                    if (Math.abs(chunk) < 7 || mean < 4e-2) return;

                    if (chunk < 0) hod.gyre = 360 - torque;
                    else hod.gyre = -324 - torque;

                    return Math.round(Math.abs((hod.gyre - cusp) / mean));
                }

                function revolveWheel(leaf, haste, flask) {

                    var cycle = {'-webkit-transition-duration': haste, 'transition-duration': haste};

                    leaf.parent().css(cycle).addClass('rotate').end().each(function () {

                        orbitSpin(this, flask, true);
                    });
                }

                function assayFlow(vial) {

                    var slant;

                    $(vial).find('div:not(.quota)').each(function (i) {

                        if (!i) {
                            var morph = $(this).css(warp) || $(this).css(veer),
                                rate = morph.replace(/[^0-9\-.,]/g, '').split(',');

                            if (rate.length == 6) slant = 0;
                            else slant = Math.round(Math.atan2(Number(rate[6]) || 0, rate[5]) * unit);
                            if (slant < 0) slant += 360;
                        }
                        else slant += 36;

                        orbitSpin(this, setDigit(slant % 360), true);
                    })
                        .end().removeClass('rotate device');
                }

                function lotRelease(fix) {

                    gate.off(yaw + ' ' + hike);
                    mound[fix].lift = true;
                }

                function setDigit(score) {

                    return Math.round(score * 1e2) / 1e2;
                }

                function nookRatio(arc) {

                    return Math.atan(arc / radius) * unit;
                }
            }

            function tallyCells() {

                cog.each(function () {

                    for (var i = 0; i < 10; i++) {

                        var n;
                        i ? n = 10 - i : n = 0;

                        $(this).append('<div></div>').find('div').eq(i).text(n).data('count', n);

                        if (i == 9) $(this).children().wrapAll('<div class="quota"></div>');
                    }
                });
            }

            function pulseMuzzle() {

                var tick = 'TransitionEvent';

                beat = tick in hub ? 'transitionend' : 'WebKit' + tick in hub ? 'webkitTransitionEnd' : '';

                $.restrain = function (delay, rouse, hind) {

                    var enact = 0, back;

                    return function () {

                        var lapse = Math.min(delay, Date.now() - enact),
                            remain = delay - lapse;
                        clearTimeout(back);
                        lapse == delay && runIt();

                        if (hind && remain) back = setTimeout(runIt, remain);

                        function runIt() {
                            enact = Date.now();
                            rouse.apply(this, arguments);
                        }
                    }
                }
            }
        });
    </script>
    <!-- Extra styles for this example -->
    <style>

        #machine {
            height: 116px;
            overflow: hidden;
        }

        .reel {
            width: 70px;
            height: 100%;
            display: inline-block;
            position: relative;
            font-size: 35px;
            line-height: 50px;
        }

        .quota, .quota div, .quota:before, .quota:after {
            width: 100%;
            height: 50px;
            position: absolute;
        }

        .quota {
            top: 33px;
            pointer-events: none;
            -webkit-perspective: 230px;
            perspective: 230px;
        }

        .reel:first-child .quota {
            -webkit-perspective-origin: 120px 50%;
            perspective-origin: 120px 50%;
        }

        .reel:last-child .quota {
            -webkit-perspective-origin: -50px 50%;
            perspective-origin: -50px 50%;
        }

        .quota div, .quota:before, .quota:after {
            -webkit-transform-origin: inherit;
            transform-origin: inherit;
        }

        .quota div {
            left: 0;
            background: url(http://ataredo.com/external/image/elect.png);
            background-size: 100% 100%;
            border-left: 2px solid #2e363e;
            border-right: 2px solid #2e363e;
            outline: 1px solid transparent;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            pointer-events: auto;
        }

        .rotate div {
            -webkit-transition-property: transform;
            transition-property: transform;
            -webkit-transition-duration: inherit;
            transition-duration: inherit;
            -webkit-transition-timing-function: linear;
            transition-timing-function: linear;
        }

        .quota:before, .quota:after {
            content: "";
            left: 0;
            z-index: 1;
        }

        .quota:before {
            background: -webkit-linear-gradient(rgba(50, 50, 50, 0.7) 10%, transparent);
            background: linear-gradient(rgba(50, 50, 50, 0.7) 10%, transparent);
            -webkit-transform: rotateX(36deg);
            transform: rotateX(36deg);
        }

        .quota:after {
            background: -webkit-linear-gradient(transparent, rgba(50, 50, 50, 0.7) 70%);
            background: linear-gradient(transparent, rgba(50, 50, 50, 0.7) 70%);
            -webkit-transform: rotateX(-36deg);
            transform: rotateX(-36deg);
        }

        #outcome {
            width: 70px;
            height: 25px;
            font-size: 15px;
            color: black;
            line-height: 25px;
            letter-spacing: 3px;
            box-shadow: 0 0 3px black;
            margin: 30px auto;
        }

        .depth {
            transform-style: preserve-3d;
        }
    </style>
    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();

            $("#hntbtn").click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "get_hint.php",
                    data: {},
                    success: function (result) {
                        var $toastContent = '<span style="word-wrap: break-word">' + result + '</span><button class="btn-flat toast-action" onclick="dismissToast()">Dismiss</button>';
                        Materialize.toast($toastContent, 100000);
                    },
                    error: function (result) {
                    }
                });
            });
        });

        function dismissToast() {
            Materialize.Toast.removeAll();
        }
    </script>
</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade
    your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->
<!-- Always shows a header, even in smaller screens. -->
<nav>
    <div class="nav-wrapper">
        <a href="../index.php" class="brand-logo">&nbsp;&nbsp;&nbsp;&nbsp;hack_it</a>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
            <li><a href="">Level : <?php echo $_SESSION['current_level'] ?></a></li>
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
            <li class="userView email"><a href=""><?php echo $_SESSION['username']; ?></a></li>
            <li><a href="">Level : <?php echo $_SESSION['current_level'] ?></a></li>
            <li><a href="../lboard.php">Leaderboard</a></li>
            <li><a href="https://www.reddit.com/r/hack_it/" target="_blank">r/hack_it</a></li>
            <li><a href="../about.php">About</a></li>
            <li><a href="../logout.php">Log Out</a></li>

        </ul>
    </div>
</nav>
<h6>lcc</h6>
<div class="row" id="ques">
    <form class="col s6" action="answer_verification.php" method="post">

        <div class="row">
            <div id="machine">
                <div class="reel"></div>
                <div class="reel" class="depth"></div>
                <div class="reel"></div>
                <div class="reel"></div>
                <div class="reel"></div>
                <div class="reel"></div>
            </div>
            <div id="outcome" class="hidden"></div>
            <div class="input-field col s12">
                <input name="answer" id="input1" class="input-field inline" type="text">
                <br/>
                <label for="input1">Answer</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
            <i class="material-icons right">send</i>
        </button>
        &nbsp;&nbsp;
        <br>
        <br>
        <button class="btn waves-effect waves-light" id="hntbtn">Hint ?</button>
        <div class="col s12">
        <span class="error"><?php if (isset($_GET['a']) && ($_GET['a']) == 'f') {
                echo "Answer is incorrect. Try again!";
            } ?></span></div>
    </form>
</div>
</body>
</html>