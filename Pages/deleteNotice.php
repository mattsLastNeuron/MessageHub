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

            .pass {
                background-color: #def2de;
                color: #42a944;
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
                .Crt {
                    width: auto;
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

                    <h1>Delete Notice</h1>
                </div>

                <div class="content">
                    <div class="Crt">
                        <h1>Delete Notice</h1>

                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        <?php } ?>

                        <?php if (isset($_GET['pass'])) { ?>
                            <p class="pass">
                                <?php echo $_GET['pass']; ?>
                            </p>
                        <?php } ?>

                        <form action="deleteNoticePro.php" method="post" onsubmit="return showConfirmation()">
                            <input type="text" placeholder="Enter Notice Title" name="delNotice" />

                            <div class="Btns">
                                <input type="submit" value="Delete" id="delete">
                                <input type="reset" value="Clear">
                            </div>
                        </form>

                        <div id="confirmationModal" class="modal">
                            <div class="modal-content">
                                <p style="color: #A94442">Are you sure you want to delete this notice?</p>
                                <button class="confirm-btn" onclick="confirmAction()">Yes</button>
                                <button class="cancel-btn" onclick="cancelAction()">No</button>
                            </div>
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