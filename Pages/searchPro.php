<?php
session_start();

include("../dbConn.php");

if (isset($_POST['search']) && ($_POST['search'] != "")) {

    $search = $_POST['search'];

    if (empty($search)) {
        header("Location: search.php?error=Please enter a valid search");
        exit();
    }

    $sql = "SELECT * FROM messagedata 
    INNER JOIN userlogin ON messagedata.sender_id = userlogin.ID
    WHERE (userlogin.UserName LIKE '%$search%' OR messagedata.message LIKE '%$search%' OR messagedata.title LIKE '%$search%') AND messagedata.receiver_id IS NOT NULL
    ORDER BY messagedata.sent_date DESC";
    $result = mysqli_query($conn, $sql);
   
    if (mysqli_num_rows($result) > 0) {
            $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);
            header("Location: searchResult.php");
            exit();
    } else {
        header("Location: search.php?error=No message found!");
        exit();
    }
} else {
    header("Location: message.php?error=Please enter a valid search");
    exit();
}
?>