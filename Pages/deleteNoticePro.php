<?php
session_start();

include("../dbConn.php");

if (isset($_POST['delNotice']) && ($_POST['delNotice'] != "")) {

    $delete = $_POST['delNotice'];

    if (empty($delete)) {
        header("Location: deleteNotice.php?error=Please enter valid notice");
        exit();
    }

    $sql = "DELETE FROM `messagedata` WHERE title = '$delete'";
    mysqli_query($conn, $sql);
    header("Location: deleteNotice.php?pass=Notice deleted");
    exit();
} else {
    header("Location: deleteNotice.php?error=Please enter valid notice");
    exit();
}
?>