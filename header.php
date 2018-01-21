<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title">hack_it</span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="lboard.php">Leader Board</a>
                <a class="mdl-navigation__link" href="https://www.reddit.com/r/hack_it/"  target="_blank">r/hack_it</a>
                <a class="mdl-navigation__link" href="about.php">About</a>
                <?php
                require ("variables.php");
                if(isset($_SESSION['username']))
                    echo "<a class=\"mdl-navigation__link\" style=\"color: white\" href=\"./logout.php\">Log Out</a>";
                else
                    echo "<a class=\"mdl-navigation__link\" style=\"color: white\" href=\"./login.php\">Log In</a>";
                ?>
            </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer" style="background: #009688">
        <span class="mdl-layout-title" style="color: white">Welcome!</span>
        <style>
            a:hover {
                color: #009688;
            }

        </style>
        <nav class="mdl-navigation">


            <a class="mdl-navigation__link" style="color: white" href="">Leader Board</a>
            <a class="mdl-navigation__link" style="color: white" href="https://www.reddit.com/r/hack_it/"  target="_blank">r/hack_it</a>
            <a class="mdl-navigation__link" style="color: white" href="about.php">About</a>
            <?php
            require ("variables.php");
            if(isset($_SESSION['username']))
                echo "<a class=\"mdl-navigation__link\" style=\"color: white\" href=\"./logout.php\">Log Out</a>";
            else
                echo "<a class=\"mdl-navigation__link\" style=\"color: white\" href=\"./login.php\">Log In</a>";
            ?>
        </nav>
    </div>
</div>