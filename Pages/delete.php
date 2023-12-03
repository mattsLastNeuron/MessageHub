<?php
session_start();

include("../dbConn.php");

if (isset($_POST['delete']) && ($_POST['delete'] != "")) {

    $delete = $_POST['delete'];
    $ID = $_SESSION['ID'];

    if (empty($delete)) {
        header("Location: read.php?error=Please select a message");
        exit();
    }

    $sql = "UPDATE messagedata SET deleted = 1 WHERE receiver_id = '$ID' AND title = '$delete'";
    mysqli_query($conn, $sql);
    header("Location: read.php");
    exit();
} else {
    header("Location: read.php?error=Please select a valid message");
    exit();
}
?>