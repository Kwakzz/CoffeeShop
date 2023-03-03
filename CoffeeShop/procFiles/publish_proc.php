<?php
session_start();

// if the user either publishes the article or saves it as a draft
if (isset($_GET['publish']) || isset($_GET['save_draft']))  {

    $title = $_GET['title'];
    $subtitle = $_GET['subtitle'];
    $content = $_GET['content'];

    if (!$_SESSION['subscriber_id']) {
        echo "sign in first";
    }

    
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
 

    // if the user saves it as a draft
    if (isset($_GET['save_draft'])) {

        $sql = "INSERT INTO `Drafts` (`draft_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', '$imgContent', '$content', '$_SESSION[$subscriberId]')";
   

    }

    // if the user publishes
    if (isset($_GET['publish'])) {

            $sql = "INSERT INTO `Published` (`published_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', '$imgContent', '$content', '$_SESSION[$subscriberId]')";

    }


    $result = mysqli_query($conn, $sql);
            
	// check if query worked
	if ($result === TRUE) {
        // redirect to articles page
        header("Location: ../frontEnd/articles.php");
        exit();
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
 

    // if the user saves it as a draft
    if (isset($_GET['save_draft'])) {

        $sql = "INSERT INTO `Drafts` (`draft_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', NULL, '$content', '$_SESSION[$subscriberId]')";
   

    }

    // if the user publishes
    if (isset($_GET['publish'])) {

            $sql = "INSERT INTO `Published` (`published_id`, `time_published`, `title`, `subtitle`, `feature_image`, `content`, `subscriber_id`) VALUES (NULL, current_timestamp(), '$title', '$subtitle', NULL, '$content', '$_SESSION[$subscriberId]')";

    }

    $result = mysqli_query($conn, $sql);
            
	// check if query worked
	if ($result === TRUE) {
        // redirect to articles page
        header("Location: ../frontEnd/articles.php");
        exit();
	}

    else {
		//echo error 
		echo "Error: " . $sql . "<br>" . mysqli_connect_error();
	}
}

}

if (isset($_GET['discard'])) {

    //redirect to homepage
    header("Location: ../index.php");
    exit();
}


?>