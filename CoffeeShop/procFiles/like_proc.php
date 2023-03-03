<?php

session_start();

if (isset($_GET["like"])) {

	// id of post being liked
	$published_id =  $_GET['published_id'];

    include ('../helperFunctions/dbConnect.php');

    $subscriberId = 'subscriber_id';

    $sql = "INSERT INTO `Likes` (`like_id`,`time_liked`, `subscriber_id`, `published_id`) VALUES (NULL, current_timestamp(), '$_SESSION[$subscriberId]', NULL)";

    $result = mysqli_query($conn, $sql);
            
	// check if query worked
	if ($result === TRUE) {
		echo "Liked";
        // stay on page
	}

    else {
		//echo error but continue executing the code to close the session
		echo "Error: " . $sql . "<br>" . mysqli_connect_error();
	}
  
}

?>