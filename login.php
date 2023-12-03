<?php
session_start();
include("dbConn.php");

if (isset($_POST["uname"]) && isset($_POST["psw"])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST["uname"]);
    $pass = validate($_POST["psw"]);

    if (empty($uname)) {
        header("Location: index.php?error=Username is required");
        exit();
    } else if (empty($pass) || ($pass != $pass) ) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM userlogin WHERE UserName = '$uname' AND UserPassword = '$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['UserName'] === $uname && $row['UserPassword'] === $pass){
                $_SESSION['UserName'] = $row['UserName'];
                $_SESSION['Position'] = $row['Position'];
                $_SESSION['ProfilePicture'] = $row['ProfilePicture'];
                $_SESSION['ID'] = $row['ID'];
                header("Location: Pages/loading.php");
                exit();
            } 
        } else {
            header("Location: index.php?error=Invalid User name or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
?>