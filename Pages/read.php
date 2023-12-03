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
        <title>Read Messages</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubLogo.png" type="image/x-icon">
        <style>
            .messages {
                width: 100%;
                display: flex;
                flex-direction: column;
            }

            table {
                width: 100%;
                table-layout: fixed;
            }

            tbody {
                display: flex;
                flex-direction: column;
                gap: 2rem;
                padding-top: .5rem;
            }

            td {
                padding: .5rem;
            }

            .default {
                text-align: center;
            }

            .message {
                background-color: white;
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: .5rem;
                border-left: solid #de985d 5px;
                border-radius: 10px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            .message:hover {
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .fromTitle {
                border-bottom: 1px solid #de985d;
            }

            .date {
                text-align: right;
            }

            .messageText {
                width: 100%;
                word-wrap: break-word;
                font-size: larger;
            }

            @media screen and (max-width: 768px) {
                .messageText {
                    font-size: 1.3rem;
                }
            }
        </style>
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
    
                                <a href='delete.php' class='sidebarLink'>
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

                    <h1>Read Messages</h1>
                </div>

                <div class="content">
                    <h1>Read Messages</h1>

                    <table>
                        <?php
                        $ID = $_SESSION["ID"];
                        $messages = mysqli_query($conn, "SELECT * 
                            FROM messagedata
                            INNER JOIN userlogin ON messagedata.sender_id = userlogin.ID
                            WHERE messagedata.receiver_id = $ID AND messagedata.is_read = 1
                            ORDER BY messagedata.sent_date DESC");

                        if (mysqli_num_rows($messages) == 0) {
                            ?>
                            <tr class="message">
                                <td>
                                    <h2 class="default">No read messages</h2>
                                </td>
                            </tr>
                        <?php }

                        while ($an = mysqli_fetch_array($messages)) {
                            ?>
                            <tr class="message">
                                <td class="fromTitle">
                                    <h3> <span style="color: #de985d">FROM:</span> @
                                        <?php echo $an['UserName'] ?>
                                    </h3>
                                </td>
                                <td class="fromTitle">
                                    <h3><span style="color: #de985d">SUBJECT:</span>
                                        <?php echo $an['title'] ?>
                                    </h3>
                                </td>
                                <td class="messageText">
                                    <?php echo $an['message'] ?>
                                </td>
                                <td class="date">
                                    Sent on:
                                    <?php echo $an['sent_date'] ?>
                                </td>
                            </tr>

                        <?php } ?>
                    </table>
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