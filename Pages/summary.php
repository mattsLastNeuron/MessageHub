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
        <title>Summary</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
        <style>
            .Crt {
                background-color: white;
                padding: 2rem;
                display: flex;
                flex-direction: column;
                gap: 2rem;
                border-radius: 0.25em;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .row {
                width: 100%;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                gap: 2rem;
                color: #de985d;
            }

            .sumNum {
                width: 100%;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;
                gap: 20px;
                font-size: 6rem;
            }

            .sumNum img {
                width: 100px;
                filter: invert(67%) sepia(55%) saturate(437%) hue-rotate(339deg) brightness(88%) contrast(98%);
            }

            @media screen and (max-width: 768px){
                .row {
                    flex-wrap: wrap;
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

                    <h1>Message Summary</h1>
                </div>

                <div class="content">
                    <div class="Crt">
                        <h1 style="text-align: center">Message Summary</h1>
                        <div class="row">
                            <div class="sum">
                                <h2>Messages Received</h2>

                                <div class="sumNum">
                                    <img src="../Images/envelope.svg" alt="">

                                    <script>
                                        function updateCounter1(count) {
                                            document.getElementById('counter1').innerText = count;
                                        }

                                        // Use PHP to generate JavaScript code
                                        <?php
                                        $ID = $_SESSION['ID'];
                                        $num = mysqli_query($conn, "SELECT COUNT(*) 
                                            FROM messagedata
                                            WHERE messagedata.receiver_id = $ID");

                                        while ($n = mysqli_fetch_array($num)) {
                                            $targetNumber = $n['COUNT(*)'];
                                        }


                                        for ($i = 0; $i <= $targetNumber; $i++) {
                                            echo "setTimeout(function() { updateCounter1($i); }, " . ($i * 100) . ");";
                                        }
                                        ?>
                                    </script>

                                    <p><span id="counter1"></span></p>

                                </div>
                            </div>

                            <div class="sum">
                                <h2>Unread Messages</h2>

                                <div class="sumNum">
                                    <img src="../Images/unread.svg" alt="">

                                    <script>
                                        function updateCounter2(count) {
                                            document.getElementById('counter2').innerText = count;
                                        }

                                        // Use PHP to generate JavaScript code
                                        <?php
                                        $ID = $_SESSION['ID'];
                                        $num = mysqli_query($conn, "SELECT COUNT(*) 
                                            FROM messagedata
                                            WHERE messagedata.receiver_id = $ID AND messagedata.is_read = 0");

                                        while ($n = mysqli_fetch_array($num)) {
                                            $targetNumber = $n['COUNT(*)'];
                                        }


                                        for ($i = 0; $i <= $targetNumber; $i++) {
                                            echo "setTimeout(function() { updateCounter2($i); }, " . ($i * 100) . ");";
                                        }
                                        ?>
                                    </script>

                                    <p><span id="counter2"></span></p>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="sum">
                                <h2>Sent Messages</h2>

                                <div class="sumNum">
                                    <img src="../Images/sent.svg" alt="">

                                    <script>
                                        function updateCounter3(count) {
                                            document.getElementById('counter3').innerText = count;
                                        }

                                        // Use PHP to generate JavaScript code
                                        <?php
                                        $ID = $_SESSION['ID'];
                                        $num = mysqli_query($conn, "SELECT COUNT(*) 
                                            FROM messagedata
                                            WHERE messagedata.sender_id = $ID");

                                        while ($n = mysqli_fetch_array($num)) {
                                            $targetNumber = $n['COUNT(*)'];
                                        }


                                        for ($i = 0; $i <= $targetNumber; $i++) {
                                            echo "setTimeout(function() { updateCounter3($i); }, " . ($i * 100) . ");";
                                        }
                                        ?>
                                    </script>

                                    <p><span id="counter3"></span></p>
                                </div>
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
        <script>

        </script>
    </body>

    </html>

    <?php

} else {
    header("Location: index.php");
    exit();
}
?>