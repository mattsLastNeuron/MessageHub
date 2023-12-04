<?php
session_start();

if (isset($_SESSION["ID"]) && isset($_SESSION["UserName"])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delete Notice</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
    </head>

    <body>
        <div class="crt">
            <div class="headAndCon">
                <div class="header">
                    <div class="userInfo">
                        <img src="../Images/pfp.svg" alt="pfp" width="75px">

                        <div class="userNameCrt">
                            <p><b>Hi there,</b></p>
                            <h2>
                                <?php echo "@" . $_SESSION["UserName"]; ?>
                            </h2>
                            <h3>
                                <?php echo $_SESSION["Position"]; ?>
                            </h3>
                        </div>
                    </div>

                    <button id="menu-toggle">☰</button>
                    <div class="menu">
                        <button id="menu-close">✕</button>

                        <div class="userInfoM">
                            <img src="../Images/pfp.svg" alt="pfp" width="75px">

                            <div class="userNameCrt">
                                <p><b>Hi there,</b></p>
                                <h2>
                                    <?php echo "@" . $_SESSION["UserName"]; ?>
                                </h2>
                                <h3>
                                    <?php echo $_SESSION["Position"]; ?>
                                </h3>
                            </div>
                        </div>

                        <div class="menuLinks">
                            <div class="sidebarLinks">
                                <a href="message.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/envelope.svg" alt="messages">
                                    New Messages
                                </a>
                                <a href="create.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/write.svg" alt="write">
                                    Create Message
                                </a>
                                <a href="sent.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/sent.svg" alt="sent">
                                    <p>Sent Messages</p>
                                </a>
                                <a href="read.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/read.png" alt="read">
                                    <p>Read Messages</p>
                                </a>
                                <a href="summary.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/summary.svg" alt="summary">
                                    Message Summary
                                </a>
                                <a href="about.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/info.svg" alt="Info">
                                    About
                                </a>
                            </div>


                            <?php
                            if ($_SESSION["Position"] == "admin") {
                                echo "
                                <div class='sidebarAdmin'>
                                <a href='search.php' class='sidebarLink'>
                                <img class='menuIcon' src='../Images/search.svg' alt='write'>
                                Message Search
                                </a>
    
                                <a href='deleteNotice.php' class='sidebarLink'>
                                <img class='menuIcon' src='../Images/trash.svg' alt='trash'>
                                Delete Notice
                                </a>
                            </div>
                        ";
                            }
                            ?>

                            <a class="logout" href="../index.php">Logout</a>
                        </div>

                    </div>

                    <a href="message.php" class="logoLink"><img src="../Images/MessagehubBlack.png" alt=""
                            width="100px"></a>

                    <h1>Delete Notice</h1>
                </div>

                <div class="content">
                    
                </div>
            </div>

            <div class="sidebar">
                <div class="logo">
                    <a href="message.php"><img src="../Images/messageHubWhite.png" alt="Logo" width="150px"></a>
                </div>

                <div class="sidebarLinks">
                    <a href="message.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/envelope.svg" alt="messages">
                        New Messages
                    </a>
                    <a href="create.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/write.svg" alt="write">
                        Create Message
                    </a>
                    <a href="sent.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/sent.svg" alt="sent">
                        <p>Sent Messages</p>
                    </a>
                    <a href="read.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/read.png" alt="read">
                        <p>Read Messages</p>
                    </a>
                    <a href="summary.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/summary.svg" alt="summary">
                        Message Summary
                    </a>
                    <a href="about.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/info.svg" alt="Info">
                        About
                    </a>
                </div>


                <?php
                if ($_SESSION["Position"] === "admin") {
                    echo "
                    <div class='sidebarAdmin'>
                    <a href='search.php' class='sidebarLink'>
                    <img class='menuIcon' src='../Images/search.svg' alt='write'>
                    Message Search
                    </a>

                    <a href='deleteNotice.php' class='sidebarLink'>
                    <img class='menuIcon' src='../Images/trash.svg' alt='trash'>
                    Delete Notice
                    </a>
                </div>
                        ";
                }
                ?>

                <form class="logoutForm" action="../logout.php" method="post">
                    <input type="submit" value="Logout" class="logoutBtn">
                </form>
            </div>
        </div>

        <script src="../script.js"></script>
    </body>

    </html>

    <?php

} else {
    header("Location: index.php");
    exit();
}
?>