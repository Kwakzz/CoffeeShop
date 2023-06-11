<!--password:LoremIpsum1!-->

<?php

    // start session
    session_start();

    // connect to database
    include("helper_functions/db_connect.php");

    // get signed in user's name
    $user_id = $_SESSION['subscriber_id'];
    $sql1 = "SELECT Subscribers.fname, Subscribers.lname, Subscribers.profile_pic FROM Subscribers WHERE subscriber_id = '$user_id'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $user_fname = $row1['fname'];
    $user_lname = $row1['lname'];
    $user_profile_pic = $row1['profile_pic'];

    // get article id
    $published_id = $_GET['published_id'];
    $sql2 = "SELECT title FROM Published WHERE published_id = '$published_id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $article_title = $row2['title'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/comments.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <title><?php echo $article_title ?></title>

</head>


<body>

    <!-- top header-->
     <div id="top_header">
        <!--logo-->
        <a href="index.php"><img id ="logo" src="images/coffee shop logo black.png"/></a>

        <!-- search -->
        <form method="GET" action="search_results.php">
            <input id="search" type = "search" name = "keyword" placeholder="Search article">
        </form>

        <!-- write icon -->
        <a href="write.php"><img alt="Write" id="write" src="images/write.png"/></a>

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

    <!-- heading -->
    <h1 id="heading">Comments for "<?php echo $article_title ?>"</h1>

    <!-- back to article -->
    <a href="view_article.php?published_id=<?php echo $published_id ?>"><p id ="back_to_article">Back to article</p></a>

    <!-- comment box -->
    <div id="comment_box">
        <!-- comment box -->
        <form method="POST" action="proc_files/comment_proc.php">
            <textarea id="comment" name = "comment" placeholder="Write a comment..." rows="4" cols="50"></textarea>
            <input type="hidden" name="published_id" value="<?php echo $published_id; ?>">
            <br>
            <input id="post_comment" type = "submit" name = "post_comment" value="Post">
        </form>
    </div>

    <!--retrieve comments-->
    <?php

    // query to get comments
    $sql = "SELECT Comments.comment_id, Comments.subscriber_id, Comments.published_id, Comments.content, Comments.time_commented, Subscribers.fname, Subscribers.lname, Subscribers.profile_pic FROM Comments INNER JOIN Subscribers ON Comments.subscriber_id = Subscribers.subscriber_id WHERE published_id = '$published_id' ORDER BY time_commented DESC";
    $result = mysqli_query($conn, $sql);
    $comment_count = mysqli_num_rows($result);

    // if there are comments
    if ($comment_count > 0) {

        // put the comment's attributes in an array
        while ($row= mysqli_fetch_assoc($result)) {


            $subscriber_id = $row['subscriber_id'];
            $time_commented = $row['time_commented'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $content = $row['content'];
            $profile_pic = $row['profile_pic'];

        ?>


            <!-- comment -->
            <div class ="comment">
                <!--writer's profile pic-->
                <img id="profile_pic" src = "<?php if ($profile_pic == NULL) {echo "images/default profile icon.jpeg";} else {echo "data:image/jpg;charset=utf8;base64,".base64_encode($profile_pic);}?>"/>
                <!--writer's name-->
                <a href = "view_writer.php?subscriber_id=<?php echo $subscriber_id; ?>"><p id = "name"><?php echo $fname." "; echo $lname; ?></p></a>
                <!--time commented-->
                <p id = "time_commented"><?php echo $time_commented; ?></p>
                <!--comment content-->
                <p id = "content"><?php echo $content; ?></p>
                
            </div>

    <?php

        }
    }

    else {
    ?>

        <!-- no comments -->
        <p id="no_comments">No comments yet</p>

    <?php
    }
    ?>


    <!-- link to dropdown.js -->
    <script src="scripts/dropdown.js"></script>
</body>

</html>