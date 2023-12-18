<?php
session_start();

if (isset($_SESSION["ID"]) && isset($_SESSION["UserName"])) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search Results</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
        <style>
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

            .message,
            .notice {
                background-color: white;
                width: 100%;
                display: flex;
                flex-direction: column;
                gap: .5rem;
                border-radius: 10px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
                border-left: solid #de985d 5px;
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

        </style>
    </head>

    <body>
        <div class="crt">
            <div id="headAndCon">
                <div class="header">
                <button id="menu-toggle" onclick="toggleSidebar()">☰</button>


                    <a href="message.php" class="logoLink"><img src="../Images/MessagehubBlack.png" alt=""
                            width="100px"></a>

                    <h1>Search Results</h1>
                </div>

                <div class="content">
                    <h1>Results</h1>

                    <table>
                    <?php

                    if (isset($_SESSION['search_results'])) {
                        // Display results
                        foreach ($_SESSION['search_results'] as $row) {
                            ?>
                            <tr class="message">
                                    <td class="fromTitle">
                                        <h3><span style="color: #de985d">FROM:</span> @
                                            <?php echo $row['UserName'] ?>
                                        </h3>
                                    </td>
                                    <td class="fromTitle">
                                        <h3><span style="color: #de985d">SUBJECT:</span>
                                            <?php echo $row['title'] ?>
                                        </h3>
                                    </td>
                                    <td class="messageText">
                                        <?php echo $row['message'] ?>
                                    </td>
                                    <td class="date">
                                        Sent on:
                                        <?php echo $row['sent_date'] ?>
                                    </td>
                                </tr>
                       <?php }
                        unset($_SESSION['search_results']);
                    } else {
                        echo "No results found.";
                    }

                    ?>
                    </table>
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
    header("Location: index.php");
    exit();
}
?>