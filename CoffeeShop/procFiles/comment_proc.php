<?php

session_start();

if (isset($_GET["commentBtn"])) {

        if (!empty($_GET['comment'])) {
            $comment = $_GET['comment'];
            $published_id = $_GET['published_id'];

        // connect to database    
        include ('../helperFunctions/dbConnect.php');

        $subscriberId = 'subscriber_id';

        $sql = "INSERT INTO `Comments` (`comment_id`, `time_commented`, `content`, `subscriber_id`, `published_id`) VALUES (NULL, current_timestamp(), $comment, '$_SESSION[$subscriberId]', '$published_id')";

        $result = mysqli_query($conn, $sql);
                
        // check if query worked
        if ($result === TRUE) {
            echo "Commented";

            // stay on page
        }

        else {
            //echo error 
            echo "Error: " . $sql . "<br>" . mysqli_connect_error();
        }
  
    }
}

?>