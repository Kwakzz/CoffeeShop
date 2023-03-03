<?php

session_start();

if (isset($_GET["delete_post"])) {

    $published_id = $_REQUEST['published_id'];

    include ('../helperFunctions/dbConnect.php');

    $subscriberId = 'subscriber_id';

    $sql = "DELETE FROM Published, Drafts WHERE published_id = $published_id";

    $result = mysqli_query($conn, $sql);
            
	// check if query worked
	if ($result === TRUE) {
    
        // redirect to userarticles page
        header("Location: ../index.php");
        exit();
	}

    else {
		//echo error but continue executing the code to close the session
		echo "Error: " . $sql . "<br>" . mysqli_connect_error();
	}
  
}

?>