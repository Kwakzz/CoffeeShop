<?php
session_start();


if (isset($_GET['save_changes'])) {

    $title = $_GET['title'];
    $subtitle = $_GET['subtitle'];
    $feature_image = $_GET['feature_image'];
    $content = $_GET['content'];

    include ('../helperFunctions/dbConnect.php');

    $sql = "";
    $subscriberId = 'subscriber_id';

    // update post details
    $sql = "UPDATE Published SET title='$title', subtitle = '$subtitle', feature_image = '$feature_image', content = '$content' WHERE subscriber_id='$_SESSION[$subscriberId]'";
    $result = mysqli_query($conn, $sql);

    if ($result===TRUE) {
        echo 'saved';
        //redirect to stories
    }

    else {
        //echo error but continue executing the code to close the session
      echo "Error: " . $sql . "<br>" . mysqli_connect_error();
    }

}

else {
    // redirect to stories page
}
?>