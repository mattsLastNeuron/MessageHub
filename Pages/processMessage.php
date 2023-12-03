<?php
    include("../dbConn.php");

    session_start();

    if(empty($_POST['RecipientUsername'])) {
        header("Location: create.php?error=Please select a valid user");
        exit();
    }

    $sender_id = $_SESSION['ID'];
    $receiver_Uname = $_POST['RecipientUsername'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $sql = $sql = "SELECT * FROM userlogin WHERE UserName = '$receiver_Uname'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    if ($receiver_id == "all") {
        // Send message to everyone in the database
        $stmt = $conn->prepare("INSERT INTO messagedata (sender_id, receiver_id, title, message) SELECT ?, id, ?, ? FROM users");
        $stmt->bind_param("iss", $sender_id, $title, $message);
    } else {
        if($row['UserName'] === $receiver_Uname) {
            $receiver_id = $row['ID'];
        }    
        // Send message to a specific user
        $stmt = $conn->prepare("INSERT INTO messagedata (sender_id, receiver_id, title, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $sender_id, $receiver_id, $title, $message);
    }

    if ($stmt->execute()) {
        header("Location: message.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>
