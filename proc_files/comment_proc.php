<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // connect to database
    include("../helper_functions/db_connect.php");

    // start session
    session_start();

    // if user is not signed in, redirect to login page
    if (!isset($_SESSION['subscriber_id'])) {
        header("Location: ../login.php");
        exit();
    }

    $user_id = $_SESSION['subscriber_id'];

    // if user clicked "post" button
    if (isset($_POST['post_comment'])) {

        // get comment parameters
        $comment = htmlspecialchars($_POST['comment']);
        $published_id = $_POST['published_id'];

        // query to upload to database
        $sql = "INSERT INTO `Comments` (`comment_id`, `time_commented`, `content`, `subscriber_id`, `published_id`) VALUES (NULL, current_timestamp(), '$comment', '$user_id', '$published_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: ../comments.php?published_id=$published_id");
            exit();
        }

        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


    }

    else {
        header("Location: ../index.php");
        exit();
    }




?>