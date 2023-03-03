<?php
session_start();

//check if register form was submited
//by checking if the submit button element name was sent as part of the request

if (isset($_REQUEST['save_changes'])) {

	$user_name = $_REQUEST["user_name"];
    $bio = $_REQUEST['bio'];
    $profile_pic = $_REQUEST['profile_pic'];
    $subscriberId = 'subscriber_id';

    if (!$_SESSION['subscriber_id']) {
        echo "sign in first";
    }

    if (isset($_FILES["profile_pic"]["name"])) {
    // Get file info 
    $fileName = basename($_FILES["feature_image"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

     // Allow certain file formats 
     $allowTypes = array('jpg','png','jpeg', 'heic', 'webp', 'gif'); 
     if(in_array($fileType, $allowTypes)){ 
         $image = $_FILES['profile_pic']['tmp_name']; 
         $imgContent = addslashes(file_get_contents($image)); 

    // connect to database
	include('../helperFunctions/dbConnect.php');


	// update user's first name and last name
	$sql = "UPDATE Subscribers SET username='$user_name', bio = '$bio', profile_pic = '$imgContent' WHERE subscriber_id='$_SESSION[$subscriberId]'";

	$result = mysqli_query($conn, $sql);

	// check if query worked
    if ($result === TRUE) {
        // stay on page
        header("Location: ../frontEnd/editProfile.php");
    }

    else {
        //echo error but continue executing the code to close the session
      echo "Error: " . $sql . "<br>" . mysqli_connect_error();
    }


}
    }

    else {

            // connect to database
        include('../helperFunctions/dbConnect.php');


        // update user's first name and last name
        $sql = "UPDATE Subscribers SET username='$user_name', bio = '$bio' WHERE subscriber_id='$_SESSION[$subscriberId]'";

        $result = mysqli_query($conn, $sql);

        // check if query worked
        if ($result === TRUE) {
            // stay on page
            header("Location: ../frontEnd/editProfile.php");
        }

        else {
            //echo error but continue executing the code to close the session
        echo "Error: " . $sql . "<br>" . mysqli_connect_error();
    }

    }
}



?>