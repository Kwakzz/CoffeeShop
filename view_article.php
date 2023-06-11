<!--password:LoremIpsum1!-->

<?php

session_start();

// connect to database
include("helper_functions/db_connect.php");


// published_id is sent through the url when the article's title is clicked
if (isset($_GET["published_id"])) {

    // get id of article    
    $published_id = $_GET['published_id'];

    // Set liked to 0 by default
    $liked = 0;

    // Set logged in to 0 by default
    $logged_in = 0;

    // query to get article details
    $sql = "SELECT Published.published_id, Subscribers.subscriber_id, Published.title, Published.subtitle, Published.feature_image, Published.content, DATE(time_published) as date_published, Subscribers.fname, Subscribers.lname, Subscribers.profile_pic
    FROM Published, Subscribers
    WHERE Published.published_id = $published_id AND Published.subscriber_id = Subscribers.subscriber_id";

    // execute query to get article details
    $result = mysqli_query($conn, $sql);

    // query to get number of likes
    $sql2 = "SELECT COUNT(*) as num_likes FROM Likes WHERE published_id = $published_id";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $num_likes = $row2['num_likes'];

    // query to get number of comments
    $sql3 = "SELECT COUNT(*) as num_comments FROM Comments WHERE published_id = $published_id";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);
    $num_comments = $row3['num_comments'];

    if (isset($_SESSION['subscriber_id'])) {

        $logged_in = 1;
        // user details
        $user_id = $_SESSION['subscriber_id'];


    
        // query to get number of times logged in user has liked article
        $sql5 = "SELECT COUNT(subscriber_id) as user_likes FROM Likes WHERE published_id = $published_id AND subscriber_id = $user_id";
        $result5 = mysqli_query($conn, $sql5);
        $row5 = mysqli_fetch_assoc($result5);
        $user_likes = $row4['user_likes'];
        if ($user_likes == 1) {
            $liked = 1;
        }
    }

    // article details
    while ($row = mysqli_fetch_assoc($result)) {

        $subscriber_id = $row['subscriber_id'];
        $title = $row['title'];
        $subtitle = $row['subtitle'];
        $date = $row['date_published'];
        $feature_image = $row['feature_image'];
        $content = $row['content'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $profile_pic = $row['profile_pic'];

        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/view_article.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    
    <title><?php echo $title; ?></title>
</head>

<body>
    
    <script src="scripts/like.js"></script>
    <script> src="scripts/getAlert.js"</script>

    <!-- header-->
    <div id="top_header">

        <!--logo-->
        <a href="index.php"><img id ="logo" src="images/coffee shop logo black.png"/></a>

        <!-- search -->
        <form action="search_results.php" method="GET">
            <input id="search" name = "keyword" type = "search" placeholder="Search article">
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
                    <a class="dropdown_items" <?php if (isset($_SESSION['subscriber_id'])) { ?> href='my_articles.php' <?php } else{ ?> href='login.php'<?php }?>>My Articles</a>
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


    <!-- article-->
    <div id = "article">

        <!--writer's profile pic-->
        <img id="profile_pic" src = "<?php if ($profile_pic == NULL) {echo "images/default profile icon.jpeg";} else {echo "data:image/jpg;charset=utf8;base64,".base64_encode($row['profile_pic']);}?>"/>
        <!--writer's name-->
        <a href = "view_writer.php?subscriber_id=<?php echo $subscriber_id; ?>"><p id="name"><?php echo $fname." "; echo $lname;?></p></a>
        <!--date article was published-->
        <p id="date_published">Published <?php echo $date;?></p>
        <!--title of article-->
        <p id="title"><?php echo $title;?></p>
        <!--subtitle of article-->
        <p id="subtitle"><?php echo $subtitle;?></p>


        <!-- comment and like -->
        <div id = "like_and_comment">

            <div id="like_div">
                <img title="like" id="like" src="images/like button.png" onclick= "like(<?php echo $published_id ?>, <?php echo $liked ?>, <?php echo $logged_in ?>)"/>
                <p id="no_of_likes"><?php echo $num_likes ?></p>
            </div>

            <div id="comment_div">
                <a href = "comments.php?published_id=<?php echo $published_id ?>"><img title="comment" id="comment" src="images/comment button.png"/></a>
                <p id="no_of_comments"><?php echo $num_comments ?></p>
            </div>

        </div>

        <?php
        // display feature image if there is one
        if ($feature_image!= NULL) {
            $encoded_image = base64_encode($row['feature_image']);
            echo '<img src="data:image/jpg;charset=utf8;base64,' . $encoded_image . '"/>';
        }
        ?>

        <!--content of article-->
        <p id="content"><?php echo $content; ?></p>
    </div>    

    <?php
    } 

    // if user is logged in
    if (isset($_SESSION['subscriber_id'])) {
        // if user is the writer of the article
        if ($_SESSION['subscriber_id'] == $subscriber_id) {
    ?>
        
            <!-- display delete button-->
            <a href="proc_files/delete_article_proc.php?published_id=<?php echo $published_id ?>'"><button id="delete_button">Delete</button></a>
            <?php
        }
    } 
}
?>

<!--link to javascript files-->
<script src="scripts/like.js"></script>

</body>
</html>