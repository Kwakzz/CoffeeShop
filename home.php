<!--password:LoremIpsum1!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/home.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <title>Coffee Shop</title>

</head>

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

?>

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
    <h1 id="heading">Articles for you</h1>

    <!--retrieve articles-->
    <?php

    // query to fetch articles in order of most viewed
    $sql2 = "SELECT Published.published_id, Subscribers.subscriber_id, Published.title, Published.subtitle, Published.feature_image, DATE(time_published) as date_published, count(Views.published_id) as no_of_views, Subscribers.fname, Subscribers.lname, SUBSTRING_INDEX(Published.content, ' ', 21) AS first_21_words
    FROM Published, Views, Subscribers
    WHERE Published.published_id = Views.published_id AND Published.subscriber_id = Subscribers.subscriber_id
    GROUP BY Views.published_id
    ORDER BY no_of_views DESC";

    $result2 = mysqli_query($conn, $sql2);
    $count = mysqli_num_rows($result2);

    // put the article's attributes in an array
    while ($row= mysqli_fetch_assoc($result2)) {


        $published_id = $row['published_id'];
        $subscriber_id = $row['subscriber_id'];
        $title = $row['title'];
        $date_published = $row['date_published'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $content = $row['first_21_words'];

    ?>


    <!-- article preview -->
    <div class ="article_preview">
        <a href = "view_writer.php?subscriber_id=<?php echo $subscriber_id; ?>"><p id = "name"><?php echo $fname." "; echo $lname; ?></p></a>
        <a href = "view_article.php?published_id=<?php echo $published_id; ?>"><p id = "title"><?php echo $title; ?></p></a>
        <p id = "content"><?php echo $content."..."; ?></p>
        <p id = "date_published"><?php echo $date_published; ?></p>
    </div>
    <hr id="horizontal_divider">


<?php

    }
?>

    <!-- link to dropdown.js -->
    <script src="scripts/dropdown.js"></script>
</body>

</html>