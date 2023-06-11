<!--password:LoremIpsum1!-->

<?php

// start session
session_start();

// published_id is sent through the url when the article's title is clicked
if (isset($_GET["subscriber_id"])) {

    $subscriber_id = $_GET['subscriber_id'];

    // connect to database
    include("helper_functions/db_connect.php");

    // get writer's details
    $sql = "SELECT fname, lname, profile_pic, bio, username FROM Subscribers WHERE subscriber_id = $subscriber_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $fname = $row['fname'];
    $lname = $row['lname'];
    $profile_pic = $row['profile_pic'];
    $bio = $row['bio'];
    $username = $row['username'];


    // if user is signed in, get their details
    if (isset($_SESSION['subscriber_id'])) {
    // get signed in user's name
    $user_id = $_SESSION['subscriber_id'];
    $sql1 = "SELECT Subscribers.fname, Subscribers.lname, Subscribers.profile_pic FROM Subscribers WHERE subscriber_id = '$user_id'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $user_fname = $row1['fname'];
    $user_lname = $row1['lname'];
    $user_profile_pic = $row1['profile_pic'];

}

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" rel="stylesheet" href="styles/view_writer.css"/>
        <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
        <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        
        <!-- Heading here -->
        <title><?php echo $fname." "; echo $lname; ?></title>
    </head>

<body>

    <!-- header-->
    <div id="top_header">

        <!--logo-->
        <a href="index.php"><img id ="logo" src="images/coffee shop logo black.png"/></a>

        <!--search bar-->
        <form method="GET" action="search_results.php">
            <input id="search" name="keyword" type = "search" placeholder="Search article">
        </form>

        <!-- write icon -->
        <a <?php if (isset($_SESSION['subscriber_id'])) { ?> href="write.php" <?php } else{ ?> href='login.php'<?php }?>><img alt="Write" id="write" src="images/write.png"/></a>

        <!-- profile pic dropdown -->
        <div class="dropdown">
            <!-- profile icon -->
            <img id="my_profile_pic" src = "<?php if ($user_profile_pic == NULL) {echo "images/default profile icon.jpeg";} else {echo "data:image/jpg;charset=utf8;base64,".base64_encode($user_profile_pic);}?>"/>

            <!-- drop down arrow -->
            <img id = "drop_down_arrow" src="images/down icon.png" onclick="showDropDown()"/>

            <!-- dropdown contents -->
            <div id = "dropdown_list" class="dropdown-content">

                <!-- my profile -->
                <div>
                    <img class="dropdown_images" src="images/profile icon.png"/>
                    <a class="dropdown_items" <?php if (isset($_SESSION['subscriber_id'])) { ?> href='edit_profile.php' <?php } else{ ?> href='login.php'<?php }?>>My Profile</a>
                </div>
                <hr>
                <!-- my articles -->
                <div>
                    <img class="dropdown_images" src="images/stories.png"/>
                    <a class="dropdown_items" <?php if (isset($_SESSION['subscriber_id'])) { ?> href="my_articles.php" <?php } else{ ?> href='login.php'<?php }?>>My Articles</a>
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
                    <a class="dropdown_items" <?php if (isset($_SESSION['subscriber_id'])) { ?> href='proc_files/logout_proc.php' <?php } else{ ?> href='login.php'<?php }?>>Log Out</a>
                </div>
            </div>
        </div>
    </div>

    <p id = "heading"><?php echo $fname." "; echo $lname."'s Articles"; ?></p>

    
    <?php
    // query to fetch articles in order of most viewed
    $sql = "SELECT Published.published_id, Subscribers.subscriber_id, Published.title, Published.feature_image, DATE(time_published) as date_published, Subscribers.fname, Subscribers.lname, Subscribers.profile_pic, Subscribers.bio, Subscribers.username, SUBSTRING_INDEX(Published.content, ' ', 21) AS first_21_words
    FROM Published, Subscribers
    WHERE Subscribers.subscriber_id = $subscriber_id AND Published.subscriber_id = Subscribers.subscriber_id
    GROUP BY date_published
    ORDER BY date_published DESC";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // put the article's attributes in an array
    while ($row= mysqli_fetch_assoc($result)) {


        $published_id = $row['published_id'];
        $title = $row['title'];
        $date_published = $row['date_published'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $content = $row['first_21_words'];

        ?>

    <!-- article preview -->
    <div class ="article_preview">
        <a href = "view_article.php?published_id=<?php echo $published_id; ?>"><p id = "title"><?php echo $title; ?></p></a>
        <p id = "content"><?php echo $content."..."; ?></p>
        <p id = "date_published"><?php echo $date_published; ?></p>
    </div>
    <hr id="horizontal_divider">

    <?php 
    }

}
    ?>

    <!-- Display writer's details here -->
    <div id="right_section">
        <p id="profile_header"><?php echo $fname."'s Profile"; ?></p>
        <img id="profile_pic" src = "<?php if ($profile_pic == NULL) {echo "images/default profile icon.jpeg";} else {echo "data:image/jpg;charset=utf8;base64,".base64_encode($row['profile_pic']);}?>"/>
        <p id="username"><?php echo "@".$username; ?></p>
        <p id="bio">Bio: <?php echo $bio ?></p>
    </div>

</body>
</html>