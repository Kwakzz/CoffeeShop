<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to database
include("../helper_functions/db_connect.php");

session_start();

// get user id
$subscriber_id = $_SESSION['subscriber_id'];

// check if user clicked save
if (isset($_POST['save'])) {

    // get user input
    $username = $_POST['username'];
    $bio = $_POST['bio'];

    // check if user uploaded a profile picture
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] !== UPLOAD_ERR_NO_FILE) {

        // Get file info
        $uploaded_profile_pic = $_FILES['profile_pic'];
        $imgContent = addslashes(file_get_contents($uploaded_profile_pic['tmp_name'])); 

        // update user details in database
        $sql = "UPDATE Subscribers SET username='$username', bio = '$bio', profile_pic = '$imgContent' WHERE subscriber_id='$subscriber_id'";

        $result = mysqli_query($conn, $sql);

        // check if query was successful
        if ($result === TRUE) {
            // redirect user to home page
            header("Location: ../home.php");
            exit();
        }

        else {
            //echo error but continue executing the code to close the session
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }
    
    // if user did not upload a profile picture
    else {
        // query to update database
        $sql = "UPDATE Subscribers SET username = '$username', bio = '$bio' WHERE subscriber_id = '$subscriber_id'";
        $result = mysqli_query($conn, $sql);

        // check if query was successful
        if ($result === TRUE) {
            // redirect user to home page
            header("Location: ../home.php");
            exit();
        }

        else {
            //echo error but continue executing the code to close the session
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    

}

if (isset($_POST['cancel'])) {
    // redirect user to home page
    header("Location: ../home.php");
    exit();
}

else {
    // redirect user to home page
    header("Location: ../home.php");
    exit();
}


?>