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
        <title>Messages</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
        <style>
            .content {
                gap: 2rem;
            }

            .notices,
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

            .notice {
                color: #A94442;
                border-left-color: #A94442;
            }

            .message:hover,
            .notice:hover {
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .fromTitle {
                border-bottom: 1px solid #de985d;
            }

            .noTitle {
                border-bottom: 1px solid #A94442;
            }

            .date {
                text-align: right;
            }

            .messageText {
                width: 100%;
                word-wrap: break-word;
                font-size: larger;
            }

            .selectReadIcon {
                position: fixed;
                display: flex;
                align-items: center;
                justify-content: center;
                bottom: 20px;
                right: 20px;
                width: 60px;
                height: 60px;
                background-color: white;
                border: 5px solid #de985d;
                border-radius: 50%;
                padding: 1rem;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            @keyframes tilt-shaking {
                0% {
                    transform: rotate(0deg);
                }

                25% {
                    transform: rotate(5deg);
                }

                50% {
                    transform: rotate(0eg);
                }

                75% {
                    transform: rotate(-5deg);
                }

                100% {
                    transform: rotate(0deg);
                }
            }

            .selectReadIcon:hover {
                background-color: #de985d;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                animation: tilt-shaking 0.25s infinite;
            }

            .selectReadIcon:active {
                transform: translate(0px, 10px);
            }

            .selectReadIcon img {
                width: 23.5px;
            }

            .selectRead {
                background-color: white;
                width: 20rem;
                padding: 1rem;
                border-radius: 10px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 1rem;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                position: fixed;
                bottom: 25px;
                right: 25px;
                display: none;
                transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            }

            .selectRead form {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 1rem;
            }

            .sentBtn,
            .closeRead {
                background: white;
                color: #de985d;
                border: 2px solid #de985d;
                font-size: 1rem;
                height: 50px;
                width: 100%;
                text-shadow: none;
                transition: 0.3s ease-in-out;
            }

            .closeRead {
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
            }

            .sentBtn:hover,
            .closeRead:hover {
                background-color: #de985d;
                color: white;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .sentBtn:active,
            .closeRead:active {
                transform: translate(0px, 10px);
            }

            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border: 0;
                outline: 0;
                font: inherit;
                width: 15em;
                height: 3em;
                padding: 0 4em 0 1em;
                background: url(https://upload.wikimedia.org/wikipedia/commons/9/9d/Caret_down_font_awesome_whitevariation.svg) no-repeat right 0.8em center/1.4em, linear-gradient(to left, rgba(222, 152, 93, 1) 3em, rgba(255, 255, 255, .7) 3em);
                color: black;
                border-radius: 0.25em;
                box-shadow: 0 0 1em 0 rgba(0, 0, 0, 0.2);
                cursor: pointer;
            }

            select option {
                color: inherit;
                background-color: rgba(222, 152, 93, .7);
            }

            select:focus {
                outline: none;
            }

            select::-ms-expand {
                display: none;
            }

            .error {
                background-color: #F2DEDE;
                color: #A94442;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
            }

            @media screen and (max-width: 768px) {
                .selectRead {
                    display: flex;
                    position: relative;
                    bottom: 0;
                    right: 0;
                }

                .selectReadIcon {
                    display: none;
                }

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
                                    <p>New Messages</p>
                                </a>
                                <a href="create.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/write.svg" alt="write">
                                    <p>Create Message</p>
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
                                    <p>Message Summary</p>
                                </a>
                                <a href="about.php" class="sidebarLink">
                                    <img class="menuIcon" src="../Images/info.svg" alt="Info">
                                    <p>About</p>
                                </a>
                            </div>

                            <?php
                            if ($_SESSION["Position"] == "admin") {
                                echo "
                                    <div class='sidebarAdmin'>
                            
                                    <a href='search.php' class='sidebarLink'>
                                    <img class='menuIcon' src='../Images/search.svg' alt='write'>
                                    <p>Message Search</p>
                                    </a>
    
                                    <a href='deleteNotice.php' class='sidebarLink'>
                                    <img class='menuIcon' src='../Images/trash.svg' alt='trash'>
                                    <p>Delete Notice</p>
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

                    <h1>New Messages</h1>
                </div>

                <div class="content" id="content">
                    <div class="notices">
                        <h1>Notices</h1>
                        <table>
                            <?php
                            $messages = mysqli_query($conn, "SELECT * 
                            FROM messagedata
                            WHERE messagedata.receiver_id IS NULL
                            ORDER BY messagedata.sent_date DESC");

                            if (mysqli_num_rows($messages) == 0) {
                                ?>
                                <tr class="notice">
                                    <td>
                                        <h2 class="default">No new notices</h2>
                                    </td>
                                </tr>
                            <?php }

                            while ($an = mysqli_fetch_array($messages)) {
                                ?>
                                <tr class="notice">
                                    <td class="noTitle">
                                        <h3>SUBJECT:
                                            <?php echo $an['title'] ?>
                                        </h3>
                                    </td>
                                    <td class="messageText">
                                        <h4><i>
                                                <?php echo $an['message'] ?><i></h4>
                                    </td>
                                    <td class="date">
                                        Sent on:
                                        <?php echo $an['sent_date'] ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>

                    <div class="messages">
                        <h1>Messages</h1>
                        <table>
                            <?php
                            $ID = $_SESSION["ID"];
                            $messages = mysqli_query($conn, "SELECT * 
                            FROM messagedata
                            INNER JOIN userlogin ON messagedata.sender_id = userlogin.ID
                            WHERE messagedata.receiver_id = $ID AND messagedata.is_read = 0
                            ORDER BY messagedata.sent_date DESC");

                            if (mysqli_num_rows($messages) == 0) {
                                ?>
                                <tr class="message">
                                    <td>
                                        <h2 class="default">No new messages</h2>
                                    </td>
                                </tr>
                            <?php }

                            while ($an = mysqli_fetch_array($messages)) {
                                ?>
                                <tr class="message">
                                    <td class="fromTitle">
                                        <h3><span style="color: #de985d">FROM:</span> @
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

                    <div class="selectReadIcon" id="selectReadIcon" onclick="showRead(this)">
                        <img src="../Images/read.png" alt="read">
                    </div>

                    <div class="selectRead" id="selectRead">
                        <h2>Select Message As Read</h2>

                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        <?php } ?>

                        <form method="post" action="processSelect.php">
                            <select name="read">
                                <option value="" disabled selected>--Select Message--</option>
                                <?php
                                $Titles = mysqli_query($conn, "SELECT * 
                            FROM messagedata
                            INNER JOIN userlogin ON messagedata.sender_id = userlogin.ID
                            WHERE messagedata.receiver_id = $ID AND messagedata.is_read = 0
                            ORDER BY messagedata.sent_date DESC");
                                while ($t = mysqli_fetch_array($Titles)) {
                                    ?>
                                    <option value="<?php echo $t['title'] ?>">
                                        <?php echo $t['title'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <input class="sentBtn" type="submit" value="Mark As Read">

                            <div class="closeRead" onclick="closeRead()">
                                <p>Close</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="sidebar">
                <div class="logo">
                    <a href="message.php"><img src="../Images/messageHubWhite.png" alt="Logo" width="150px"></a>
                </div>


                <div class="sidebarLinks">
                    <a href="message.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/envelope.svg" alt="messages">
                        <p>New Messages</p>
                    </a>
                    <a href="create.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/write.svg" alt="write">
                        <p>Create Message</p>
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
                        <p>Message Summary</p>
                    </a>
                    <a href="about.php" class="sidebarLink">
                        <img class="menuIcon" src="../Images/info.svg" alt="Info">
                        <p>About</p>
                    </a>
                </div>

                <?php
                if ($_SESSION["Position"] === "admin") {
                    echo "
                        <div class='sidebarAdmin'>
                            
                                <a href='search.php' class='sidebarLink'>
                                <img class='menuIcon' src='../Images/search.svg' alt='write'>
                                <p>Message Search</p>
                                </a>

                                <a href='deleteNotice.php' class='sidebarLink'>
                                <img class='menuIcon' src='../Images/trash.svg' alt='trash'>
                                <p>Delete Notice</p>
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
            function showRead(clickedDiv) {
                const hiddenDiv = document.getElementById('selectRead');

                hiddenDiv.style.display = 'flex';

                clickedDiv.style.display = 'none';
            }

            function closeRead() {
                const Icon = document.getElementById('selectReadIcon');
                const openDiv = document.getElementById('selectRead');

                Icon.style.display = 'flex';

                openDiv.style.display = 'none';
            }
        </script>
    </body>

    </html>

    <?php

} else {
    header("Location: index.php");
    exit();
}
?>