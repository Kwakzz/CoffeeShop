<!--password:LoremIpsum1!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/index.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <title>Coffee Shop</title>
</head>

<?php

    // start session
    session_start();

    // if user is logged in, redirect to home page
    if (isset($_SESSION['subscriber_id'])) {
        header("Location: home.php");
    }

?>

<body>

    <!-- Sign in and Sign Up buttons here-->
    <div id="top_header">
        <a href="login.php"><span id="sign_in">Sign in</span></a>
        <a href="signup.php"><span id="sign_up">Start writing</span></a>
    </div>

    <!-- Search bar and Sign Up buttons here-->
    <div id="bottom_header">
        <img id = "logo" src="images/coffee shop.png"/>
        <div id="motto_and_description">
            <h4 id="motto">A WRITER'S HOME</h4>
            <p id="description">Read others' thoughts and<br>share yours with the world</p>
        </div>
        <form method="GET" action="search_results.php">
            <input type="search" name="keyword" id="search" placeholder="Search article">
        </form>
    </div>

    <!-- What's trending?-->
    <div id="trending">
        <img id="trending_icon" src = "images/trending.png"/>
        <p id="heading">What's everyone reading?</p>
    </div>

    <!--retrieve articles-->
    <?php

    include("helper_functions/db_connect.php");

    // query to fetch articles in order of most viewed
    $sql = "SELECT Published.published_id, Subscribers.subscriber_id, Published.title, Published.subtitle, Published.feature_image, DATE(time_published) as date_published, count(Views.published_id) as no_of_views, Subscribers.fname, Subscribers.lname, SUBSTRING_INDEX(Published.content, ' ', 21) AS first_21_words
    FROM Published, Views, Subscribers
    WHERE Published.published_id = Views.published_id AND Published.subscriber_id = Subscribers.subscriber_id
    GROUP BY Views.published_id
    ORDER BY no_of_views DESC";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // put the article's attributes in an array
    while ($row= mysqli_fetch_assoc($result)) {


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

    

</body>

</html>