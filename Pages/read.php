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
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
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

            .deleteIcon {
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

            .deleteIcon:hover {
                background-color: #de985d;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
                animation: tilt-shaking 0.25s infinite;
            }

            .deleteIcon:active {
                transform: translate(0px, 10px);
            }

            .deleteIcon img {
                width: 23.5px;
            }

            .delete {
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

            .delete form {
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

            .modal {
                display: none;
                position: fixed;
                z-index: 150;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.7);
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background-color: white;
                padding: 20px;
                border: 1px solid #888;
                border-radius: 5px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .confirm-btn,
            .cancel-btn {
                background: white;
                color: #de985d;
                border: 2px solid #de985d;
                font-size: 1rem;
                padding: .5rem;
                text-shadow: none;
                transition: 0.3s ease-in-out;
            }

            .confirm-btn:hover,
            .cancel-btn:hover {
                background-color: #de985d;
                color: white;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .confirm-btn:active,
            .cancel-btn:active {
                transform: translate(0px, 10px);
            }


            @media screen and (max-width: 768px) {
                .messageText {
                    font-size: 1.3rem;
                }

                .delete {
                    display: flex;
                    position: relative;
                    bottom: 0;
                    right: 0;
                }

                .deleteIcon {
                    display: none;
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
                            WHERE messagedata.receiver_id = $ID AND messagedata.is_read = 1 AND messagedata.deleted = 0
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

                    <div class="deleteIcon" id="deleteIcon" onclick="showDelete(this)">
                        <img src="../Images/delete.png" alt="read">
                    </div>

                    <div class="delete" id="delete">
                        <h2>Select Message To Delete</h2>

                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        <?php } ?>

                        <form method="post" action="delete.php" onsubmit="return showConfirmation()">
                            <select name="delete">
                                <option value="" disabled selected>--Select Message--</option>
                                <?php
                                $Titles = mysqli_query($conn, "SELECT * 
                            FROM messagedata
                            INNER JOIN userlogin ON messagedata.sender_id = userlogin.ID
                            WHERE messagedata.receiver_id = $ID AND messagedata.deleted = 0
                            ORDER BY messagedata.sent_date DESC");
                                while ($t = mysqli_fetch_array($Titles)) {
                                    ?>
                                    <option value="<?php echo $t['title'] ?>">
                                        <?php echo $t['title'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <input class="sentBtn" type="submit" value="Delete">

                            <div class="closeRead" onclick="closeDelete()">
                                <p>Close</p>
                            </div>
                        </form>
                    </div>

                    <div id="confirmationModal" class="modal">
                            <div class="modal-content">
                                <p style="color: #A94442">Are you sure you want to delete this notice?</p>
                                <button class="confirm-btn" onclick="confirmAction()">Yes</button>
                                <button class="cancel-btn" onclick="cancelAction()">No</button>
                            </div>
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
            function showDelete(clickedDiv) {
                const hiddenDiv = document.getElementById('delete');

                hiddenDiv.style.display = 'flex';

                clickedDiv.style.display = 'none';
            }

            function closeDelete() {
                const Icon = document.getElementById('deleteIcon');
                const openDiv = document.getElementById('delete');

                Icon.style.display = 'flex';

                openDiv.style.display = 'none';
            }

            function showConfirmation() {
                var modal = document.getElementById("confirmationModal");
                modal.style.display = "flex";
                return false; // Prevent form submission
            }

            function confirmAction() {
                document.forms[0].submit();
            }

            function cancelAction() {
                var modal = document.getElementById("confirmationModal");
                modal.style.display = "none";
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