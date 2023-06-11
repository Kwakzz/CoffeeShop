<!--password:LoremIpsum1!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/write.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <title>Write</title>
</head>

<?php

    // start session
    session_start();

    // connect to database
    include("helper_functions/db_connect.php");

    // get signed in user's name
    $user_id = $_SESSION['subscriber_id'];
    $sql = "SELECT Subscribers.fname, Subscribers.lname, Subscribers.profile_pic FROM Subscribers WHERE subscriber_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $user_fname = $row['fname'];
    $user_lname = $row['lname'];
    $profile_pic = $row['profile_pic'];

?>

<body>


     <!-- header-->
     <div id="top_header">
        <a href="index.php"><img id ="logo" src="images/coffee shop logo black.png"/></a>

        <!-- search -->
        <form action="search_results.php" method="GET">
            <input id="search" name="keyword" type = "search" placeholder="Search article">
        </form>

         <!-- profile pic dropdown -->
        <div class="dropdown">
            <!-- profile icon -->
            <img id="my_profile_pic" src = "<?php if ($profile_pic == NULL) {echo "images/default profile icon.jpeg";} else {echo "data:image/jpg;charset=utf8;base64,".base64_encode($profile_pic);}?>"/>

            <!-- drop down arrow -->
            <img id = "drop_down_arrow" src="images/down icon.png" onclick="showDropDown()"/>

            <!-- dropdown contents -->
            <div id = "dropdown_list" class="dropdown-content">

                <!-- my profile -->
                <div>
                    <img class="dropdown_images" src="images/profile icon.png"/>
                    <a class="dropdown_items" href="edit_profile.php">My Profile</a>
                </div>
                <hr>
                <!-- my articles -->
                <div>
                    <img class="dropdown_images" src="images/stories.png"/>
                    <a class="dropdown_items" href="my_articles.php">My Articles</a>
                </div>
                <hr>
                <!-- settings -->
                <div>
                    <img class="dropdown_images" src="images/settings.png"/>
                    <a class="dropdown_items" href="#">Settings</a>
                </div>
                <hr>
                <!-- log out -->
                <div>
                    <img class="dropdown_images" src="images/logout.png"/>
                    <a class="dropdown_items" href="proc_files/logout_proc.php">Log Out</a>
                </div>
            </div>
        </div>


    </div>

    <!-- form -->
    <form action="proc_files/publish_proc.php" method="POST" enctype="multipart/form-data">
        <div id = "form">

            <input type="submit" value="Publish" id="publish" name="publish">

            <input type="text" id = "title" name="title" placeholder= "Title">
            <br>

            <input type="text" id = "subtitle" name="subtitle": placeholder="Subtitle">
            <br>

            <label for="feature_image">Feature image: </label>
            <input type="file" id = "feature_image" name="feature_image" accept="image/*">
            <br>

            <textarea id = "content" name="content" placeholder="Write here..." rows="4" oninput="autoAdjust(this)"></textarea>
        </div>

    </form>

    <script src="scripts/autoAdjustTextArea.js"></script>
</body>
