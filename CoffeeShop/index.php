<?php
session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffeeshop</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Lusitana:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Lusitana:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=Lusitana&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/homepage.css">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Jura:wght@300;400;500&family=Lora&family=Notable&family=Open+Sans:wght@300;400;600&family=Roboto&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Jura:wght@300;400;500&family=Lora&family=Notable&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">

</head>
<body>

<!-- if no one is signed in, display this page. -->
<?php 
if (!isset($_SESSION['subscriber_id'])) { 
    ?>

<div class="signin">

<a href="frontEnd/login.php" class="loginlink"> Sign in</a>
<a href="frontEnd/write.php" class="custom-link">Start Writing </a>


</div>
<div class="top-div">
<div class="logo">
<img class="logo" id="logo" src="Accessories/the coffee shop logo (black background).png" alt="logo">
 </div>
 
 <div class="writerhome">
    <p class="header-info1">A WRITER'S HOME </p>
</div>
<div class="read">
    <p>Read other's thoughts and share yours with the world </p>
</div>
<form action="procFiles/search_proc.php" method="GET">
    <input type="search" name="search" id="search" class="search" placeholder="Search">
    
</form>


   
</div>

<div class="nextdiv">
<div class="trends">
    <img class="trending" src="Accessories/trending.png" alt="trending">
<h2 class="trend-text">What's everyone reading?</h2> 
</div>

<?php 
    
    include("helperFunctions/dbConnect.php");

    // trending articles (articles with the most views)
    $sql = "SELECT Published.published_id, Subscribers.subscriber_id, Published.title, Published.subtitle, Published.feature_image, DATE(time_published) as date_published, count(Views.published_id) as no_of_views, Subscribers.fname, Subscribers.lname
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
        $subtitle = $row['subtitle'];
        $feature_image = $row['feature_image'];
        $date_published = $row['date_published'];
        $fname = $row['fname'];
        $lname = $row['lname'];

            ?>

            <!-- html display -->
            <div class = "article">
            <div class="articlecontent">
            <a class="name" href="procFiles/viewWriter.php?subscriber_id=<?php echo $subscriber_id;?>"> <p class="name"> <img class="icon" src="../Accessories/blank pic.png" alt=""> <?php echo $fname ." ". $lname;?><p></a>
            <a class="title" href="procFiles/viewArticle.php?published_id=<?php echo $published_id;?>"> <p class="title"><?php echo $title . ": ". $subtitle;?><p></a>
            <p class="date"><?php echo $date_published;?><p>           
            </div>
            <div class="articleimage">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['feature_image']); ?>"/>

            </div>
            </div>
         <?php
    }
    ?>

    <!-- if there's no article, echo, "No articles yet..."-->

    <?php 
            if ($count == 0) {
                ?>
                <p><?php echo "No articles yet...";?></p>

            <?php } ?> 

<?php } ?>




<!-- if user is signed in, display this page. -->
<?php 
if (isset($_SESSION['subscriber_id'])) { 
    ?>

<div class="signin">

<a href="frontEnd/login.php" class="loginlink"> Sign in</a>
<a href="frontEnd/write.php" class="custom-link">Start Writing </a>


</div>
<div class="top-div">
<div class="logo">
<img class="logo" id="logo" src="Accessories/the coffee shop logo (black background).png" alt="logo">
 </div>
 
 <div class="writerhome">
    <p class="header-info1">A WRITER'S HOME </p>
</div>
<div class="read">
    <p>Read other's thoughts and share yours with the world </p>
</div>
<form action="procFiles/search_proc.php" method="GET">
    <input type="search" name="search" id="search" class="search" placeholder="Search">
    
</form>


   
</div>

<div class="nextdiv">
<div class="trends">
    <img class="trending" src="Accessories/trending.png" alt="trending">
<h2 class="trend-text">What's everyone reading?</h2> 
</div>

<?php 
    
    include("helperFunctions/dbConnect.php");

    // trending articles (articles with the most views)
    $sql = "SELECT Published.published_id, Subscribers.subscriber_id, Published.title, Published.subtitle, Published.feature_image, DATE(time_published) as date_published, count(Views.published_id) as no_of_views, Subscribers.fname, Subscribers.lname
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
        $subtitle = $row['subtitle'];
        $feature_image = $row['feature_image'];
        $date_published = $row['date_published'];
        $fname = $row['fname'];
        $lname = $row['lname'];

            ?>

            <!-- html display -->
            <div class = "article">
            <div class="articlecontent">
            <a class="name" href="procFiles/viewWriter.php?subscriber_id=<?php echo $subscriber_id;?>"> <p class="name"> <img class="icon" src="Accessories/blank pic.png" alt=""> <?php echo $fname ." ". $lname;?><p></a>
            <a class="title" href="procFiles/viewArticle.php?published_id=<?php echo $published_id;?>"> <p class="title"><?php echo $title . ": ". $subtitle;?><p></a>
            <p class="date"><?php echo $date_published;?><p>           
            </div>
            <div class="articleimage">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['feature_image']); ?>"/>

            </div>
            </div>
         <?php
    }
    ?>

    <!-- if there's no article, echo, "No articles yet..."-->

    <?php 
            if ($count == 0) {
                ?>
                <p><?php echo "No articles yet...";?></p>

            <?php } ?> 

<?php } ?>

</body>
</html>

