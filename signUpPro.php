<?php

include("dbConn.php");

if (isset($_POST['uname']) && isset($_POST['psw'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST["uname"]);
    $pass = validate($_POST["psw"]);
    $pass2 = validate($_POST['repsw']);
    $position = validate($_POST['position']);

    if (empty($uname)) {
        header("Location: signUp.php?error=Username is required");
        exit();
    } else if (empty($pass) || ($pass != $pass2) || empty($pass2)) {
        header("Location: signUp.php?error=Valid password is required");
        exit();
    } else if (empty($position)) {
        header("Location: signUp.php?error=Please select a position");
        exit();
    }

    function is_valid_password($pass) {
        // Minimum length of 8 characters
        $min_length = 8;
    
        // Check if the password meets the minimum length requirement
        if (strlen($pass) < $min_length) {
            header("Location: signUp.php?error=Password must be at least 8 characters");
            exit();
        }
    
        // Check if the password contains at least one uppercase letter, one lowercase letter, and one digit
        if (!preg_match('/[A-Z]/', $pass)) {
            header("Location: signUp.php?error=Password must contain at least one uppercase letter");
            exit();
        }

        if (!preg_match('/[a-z]/', $pass)) {
            header("Location: signUp.php?error=Password must contain at least one lowercase letter");
            exit();
        }

        if (!preg_match('/[0-9]/', $pass)) {
            header("Location: signUp.php?error=Password must contain at least one number");
            exit();
        }

        if (!preg_match('/[^A-Za-z0-9]/', $pass)) {
            header("Location: signUp.php?error=Password must contain at least one special character");
            exit();
        }
    }

    is_valid_password($pass);

    $user_check_query = "SELECT * FROM userlogin WHERE username='$uname' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);


    if ($user['username'] == $uname) {
        header("Location: signUp.php?error=User already exists");
        exit();
    }

    $sql = "INSERT INTO userlogin (UserName, UserPassword, Position) VALUES ('$uname', '$pass', '$position')";
    mysqli_query($conn, $sql);
    header("Location: index.php?pass=New user created!");
    exit();
}

?>