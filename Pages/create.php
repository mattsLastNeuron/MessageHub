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
        <title>Create Message</title>
        <link rel="stylesheet" href="../style.css">
        <link rel="shortcut icon" href="../Images/messageHubIcon.png" type="image/x-icon">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        <style>
            * {
                outline: none;
            }

            .messageForm {
                background-color: white;
                padding: 1.5em;
                border-radius: 0.25em;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .messageForm h1 {
                text-align: center;
            }

            .error {
                background-color: #F2DEDE;
                color: #A94442;
                padding: 10px;
                width: 95%;
                border-radius: 5px;
                margin-bottom: 32px;
            }

            select {
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                border: 0;
                outline: 0;
                font: inherit;
                width: 20em;
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

            .form-row {
                display: flex;
                margin: 32px 0;
            }

            .form-row .input-data {
                width: 100%;
                height: 40px;
                position: relative;
            }

            .form-row .textarea {
                height: 70px;
            }

            .input-data input,
            .textarea textarea {
                display: block;
                width: 100%;
                height: 100%;
                border: none;
                font-size: 17px;
                border-bottom: 2px solid rgba(0, 0, 0, 0.12);
            }

            .input-data input:focus~label,
            .textarea textarea:focus~label,
            .input-data input:valid~label,
            .textarea textarea:valid~label {
                transform: translateY(-20px);
                font-size: 14px;
                color: #de985d;
            }

            .textarea textarea {
                resize: none;
                padding-top: 10px;
            }

            .input-data label {
                position: absolute;
                pointer-events: none;
                bottom: 10px;
                font-size: 16px;
                transition: all 0.3s ease;
            }

            .textarea label {
                width: 100%;
                bottom: 40px;
                background: #fff;
            }

            .input-data .underline {
                position: absolute;
                bottom: 0;
                height: 2px;
                width: 100%;
                z-index: 1;
            }

            .input-data .underline:before {
                position: absolute;
                content: "";
                height: 2px;
                width: 100%;
                background: #de985d;
                transform: scaleX(0);
                transform-origin: center;
                transition: transform 0.3s ease;
            }

            .input-data input:focus~.underline:before,
            .input-data input:valid~.underline:before,
            .textarea textarea:focus~.underline:before,
            .textarea textarea:valid~.underline:before {
                transform: scale(1);
            }

            .formBtns {
                width: 100%;
                display: flex;
                justify-content: space-around;
            }

            .formBtns input {
                background: white;
                color: #de985d;
                border-style: solid;
                border-color: #de985d;
                height: 50px;
                width: 100px;
                text-shadow: none;
                transition: 0.3s ease-in-out;
            }

            .formBtns input:hover {
                background-color: #de985d;
                color: white;
                box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            }

            .formBtns input:active {
                transform: translate(0px, 10px);
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

                    <h1>Create Message</h1>
                </div>

                <div class="content">
                    <form action="processMessage.php" method="post" class="messageForm">
                        <h1>Create New Message</h1>

                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error">
                                <?php echo $_GET['error']; ?>
                            </p>
                        <?php } ?>

                        <select name="RecipientUsername" required>
                            <option value="" disabled selected hidden>--Choose a user--</option>
                            <?php
                            if ($_SESSION['Position'] === "admin") {
                                ?>
                                <option value="everyone">Everyone</option>
                            <?php } ?>
                            <?php
                            $RecipientUsernames = mysqli_query($conn, "SELECT * FROM userlogin");
                            while ($un = mysqli_fetch_array($RecipientUsernames)) {
                                ?>
                                <option value="<?php echo $un['UserName'] ?>">
                                    <?php echo $un['UserName'] ?>
                                </option>
                            <?php } ?>
                        </select><br>

                        <div class="form-row">
                            <div class="input-data">
                                <input type="text" name="title" required>
                                <div class="underline"></div>
                                <label for="title">Message Title</label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input-data textarea">
                                <textarea rows="8" cols="80" name="message" required></textarea>
                                <br />
                                <div class="underline"></div>
                                <label for="message">Write Your Message</label>
                                <br />
                            </div>
                        </div>

                        <div class="formBtns">
                            <input type="submit" value="Send">
                            <input type="reset" value="Reset">
                        </div>
                    </form>

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