<?php
session_start();

// if the user clicks either save changes or publish
if (isset($_GET['save_changes']) || isset($_GET['publish'])) {

    $title = $_GET['title'];
    $subtitle = $_GET['subtitle'];
    $feature_image = $_GET['feature_image'];
    $content = $_GET['content'];
    $draft_id = $GET['draft_id'];


    if (isset($_FILES["feature_image"]["name"])) {

        // Get file info 
        $fileName = basename($_FILES["feature_image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    
         // Allow certain file formats 
         $allowTypes = array('jpg','png','jpeg', 'heic', 'webp', 'gif'); 
         if(in_array($fileType, $allowTypes)){ 
             $image = $_FILES['feature_image']['tmp_name']; 
             $imgContent = addslashes(file_get_contents($image)); 
    

            
    include ('../helperFunctions/dbConnect.php');

    $sql = "";
    $subscriberId = 'subscriber_id';

    if (isset($_GET['save_changes'])) {
        // update draft details
        $sql = "UPDATE Drafts SET title='$title', subtitle = '$subtitle', feature_image = '$feature_image', content = '$content' WHERE subscriber_id='$_SESSION[$subscriberId]'";

    }

    if (isset($_GET['publish'])) {
        // post draft
        $sql = "INSERT INTO `Published` (`published_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', '$feature_image', '$content', '$_SESSION[$subscriberId]')";

    }

    $result = mysqli_query($conn, $sql);

    // if draft is successfully published, remove it from drafts.
    if ($result===TRUE) {
        $delete = "DELETE FROM Drafts where draft_id = '$draft_id'";
        header("Location: ../frontEnd/userarticles.php");
    }

    else {
        //echo error 
      echo "Error: " . $sql . "<br>" . mysqli_connect_error();
    }

}
    }

    else {
        include ('../helperFunctions/dbConnect.php');

    $sql = "";
    $subscriberId = 'subscriber_id';

    if (isset($_GET['save_changes'])) {
        // update draft details
        $sql = "UPDATE Drafts SET title='$title', subtitle = '$subtitle', content = '$content' WHERE subscriber_id='$_SESSION[$subscriberId]'";

    }

    if (isset($_GET['publish'])) {
        // post draft
        $sql = "INSERT INTO `Published` (`published_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', NULL, '$content', '$_SESSION[$subscriberId]')";

    }

    $result = mysqli_query($conn, $sql);

    // if draft is successfully published, remove it from drafts.
    if ($result===TRUE) {
        $delete = "DELETE FROM Drafts where draft_id = '$draft_id'";
        header("Location: ../frontEnd/userarticles.php");
    }

    else {
        //echo error 
      echo "Error: " . $sql . "<br>" . mysqli_connect_error();
    }
    }
}

else {
    // redirect to stories page
    header("Location: ../frontEnd/articles.php");
    exit();
}
?>