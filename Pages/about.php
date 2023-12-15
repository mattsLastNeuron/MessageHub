<?php
session_start();

if (isset($_SESSION["ID"]) && isset($_SESSION["UserName"])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>About</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
        <style>
            .Crt {
                display: flex;
                flex-direction: column;
                gap: 2rem;
            }
            .about {
                background-color: white;
                padding: 2rem;
                display: flex;
                flex-direction: column;
                gap: 1rem;
                border-radius: 0.25em;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .about p {
                font-size: larger;
            }

            .creators {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                width: 100%;
            }

            .creator {
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                display: flex;
                flex-direction: column;
                width: 45%;
                background-color: white;
                border-radius: 0.25em;
                text-align: center;
                gap: 1rem;
            }

            .creator img {
                width: 100%;
                max-height: 250px;
            } 

            .creator h4{
                color: gray;
                padding-bottom: 1rem;
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

                    <h1>About</h1>
                </div>

                <div class="content">
                    <div class="Crt">

                        <div class="about">
                            <h1>About</h1>

                            <p>
                                Welcome to MessageHub, your dedicated partner in efficient communication and streamlined
                                administration. At MessageHub, we understand the pivotal role that clear and concise
                                administrative messages play in the seamless functioning of any organization. Our mission is
                                to empower businesses with a robust platform that simplifies the process of crafting,
                                disseminating, and tracking administrative messages. From important announcements to policy
                                updates, our user-friendly interface ensures that your messages reach the right recipients
                                promptly. We prioritize security and customization, offering a range of features to tailor
                                your messages to the unique needs of your organization. With MessageHub, you can enhance
                                internal communication, boost productivity, and keep your team informed. Join us in
                                revolutionizing the way you manage administrative messages, making communication a strength
                                rather than a challenge.</p>
                        </div>

                        <div class="creators">
                            <div class="creator">
                                <img src="../Images/matt.jpg">

                                <h2>Matthew Ward #0132075</h2>

                                <h4>co-founder</h4>

                            </div>

                            <div class="creator">
                                <img src="../Images/garth.jpg">

                                <h2>Garth Frederiksen #0161006</h2>

                                <h4>co-founder</h4>
                            </div>
                        </div>
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

                    <a href='delete.php' class='sidebarLink'>
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