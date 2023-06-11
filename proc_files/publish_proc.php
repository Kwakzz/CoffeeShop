<?php

    // start session
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // connect to database
    include("../helper_functions/db_connect.php");

    if (isset($_POST['publish'])) {


        // collect data from form
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $content = $_POST['content'];        

        // connect to database
        include("helper_functions/db_connect.php");

        // get subscriber_id
        $subscriber_id = $_SESSION['subscriber_id'];

        // check if user uploaded a feature image
        if (isset($_FILES['feature_image']) && $_FILES['profile_pic']['error'] !== UPLOAD_ERR_NO_FILE) {
            // Get file info 

            $feature_image = $_FILES['feature_image'];
            $imgContent = addslashes(file_get_contents($feature_image['tmp_name'])); 

            // query to upload to database
            $sql = "INSERT INTO `Published` (`published_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', '$imgContent', '$content', '$subscriber_id')";
            $result = mysqli_query($conn, $sql);

            // check if query was successful
            if ($result === TRUE) {

                $sql1 = "INSERT INTO VIEWS (published_id, subscriber_id) VALUES ((SELECT published_id FROM Published WHERE content = '$content'), $subscriber_id)";

                $result1 = mysqli_query($conn, $sql1);

                if ($result == TRUE) {
                    // redirect user to home page
                    header("Location: ../home.php");
                    exit();
                }
            } 

            else {
                //echo error but continue executing the code to close the session
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }
    
        // if user did not upload a feature image
        else {
            // query to upload to database
            $sql = "INSERT INTO `Published` (`published_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', NULL, '$content', '$subscriber_id')";
            $result = mysqli_query($conn, $sql);

            // check if query was successful
            if ($result === TRUE) {

                $sql1 = "INSERT INTO VIEWS (published_id, subscriber_id) VALUES ((SELECT published_id FROM Published WHERE content = '$content'), $subscriber_id)";

                $result1 = mysqli_query($conn, $sql1);

                if ($result == TRUE) {
                    // redirect user to home page
                    header("Location: ../home.php");
                    exit();
                }
            } 

            // if query was unsuccessful
            else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

        }

    }

    // if user did not submit a post
    else {
        // redirect user to home page
        header("Location: ../home.php");
        exit();
    }

        

    

?>