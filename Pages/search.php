<?php
session_start();

include("../dbConn.php");

if (isset($_SESSION["ID"]) && isset($_SESSION["UserName"])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
        <style>
            .Crt {
                background-color: white;
                width: 40%;
                padding: 2rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 1rem;
                border-radius: 0.25em;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .Crt form {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                width: 100%;
            }

            input[type="text"],
            input[type="password"] {
                width: 100%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                box-sizing: border-box;
                outline: none;
                border: 2px solid transparent;
                border-radius: 24px;
                font-size: 1rem;
                background-color: gainsboro;
            }

            input[type="text"]:focus,
            input[type="password"]:focus {
                border: 2px rgb(222, 152, 93) solid;
            }

            .Btns {
                width: 100%;
                display: flex;
                justify-content: space-around;
            }

            .Btns input {
                background: white;
                color: #de985d;
                border-style: solid;
                border-color: #de985d;
                height: 50px;
                width: 100px;
                text-shadow: none;
                transition: 0.3s ease-in-out;
            }

            .Btns input:hover {
                background-color: #de985d;
                color: white;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .Btns input:active {
                transform: translate(0px, 10px);
            }

            .error {
                background-color: #F2DEDE;
                color: #A94442;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
            }

            @media screen and (max-width: 768px) {
                .Crt {
                    width: auto;
                }
            }
        </style>
    </head>

    <body>
        <div class="crt">
            <div id="headAndCon">
                <div class="header">
                <button id="menu-toggle" onclick="toggleSidebar()">☰</button>

                    <a href="message.php" class="logoLink"><img src="../Images/MessagehubBlack.png" alt=""
                            width="100px"></a>

                    <h1>Message Search</h1>
                </div>

                <div class="content">
                    <div class="Crt">
                        <h1>Message Search</h1>

                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        <?php } ?>

                        <form action="searchPro.php" method="post">
                            <input type="text" placeholder="Search" name="search" />

                            <div class="Btns">
                                <input type="submit" value="Search">
                                <input type="reset" value="Clear">
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div id="sidebar">
                <div class="sideTop">

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

                    <button id="menu-Close" onclick="toggleSidebar()">&#10006;</button>
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
    header("Location: ../index.php");
    exit();
}
?>