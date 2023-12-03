<?php
session_start();

include("../dbConn.php");

if (isset($_POST['read']) && ($_POST['read'] != "")) {

    $read = $_POST['read'];
    $ID = $_SESSION['ID'];

    if (empty($read)) {
        header("Location: signUp.php?error=Please select a message");
        exit();
    }

    $sql = "UPDATE messagedata SET is_read = 1 WHERE receiver_id = '$ID' AND title = '$read'";
    mysqli_query($conn, $sql);
    header("Location: message.php");
    exit();
} else {
    header("Location: message.php?error=Please select a valid message");
    exit();
}
?>