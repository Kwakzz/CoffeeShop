<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // start session
    session_start();

    // id of logged in user
    $user_id = $_SESSION['subscriber_id'];

    // connect to database
    include("../helper_functions/db_connect.php");

    // if user is not signed in, redirect to login page
    if (!isset($_SESSION['subscriber_id'])) {
        header("Location: ../login.php");
        exit();
    }

    else {

        // get id of article liked
        $published_id = $_GET['published_id'];

        // check if user has already liked article
        $sql1 = "SELECT COUNT(subscriber_id) as user_likes FROM Likes WHERE subscriber_id = '$user_id' AND published_id = '$published_id'";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $user_likes = $row1['user_likes'];
        if ($user_likes == 1) {
            header("Location: ../view_article.php?published_id=$published_id");
            exit();
        }

        // if user has not liked article, like article
        else {

            // query to upload to database
            $sql = "INSERT INTO `Likes` (`like_id`, `time_liked`, `subscriber_id`, `published_id`) VALUES (NULL, current_timestamp(), '$user_id', '$published_id')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: ../view_article.php?published_id=$published_id");
                exit();
            }

            else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }
    }

    


?>