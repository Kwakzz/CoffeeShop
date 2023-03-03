<?php
session_start();
include ('../helperFunctions/dbConnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/articles.css">


</head>
<body>

    <div class="top-div">
        <header class="left-head">
             <img class="logo" id="logo" src="../Accessories/the coffee shop logo 2.png" alt="coffee-shop logo">
            <form action="../procFiles/search_proc.php" method="GET">
            <input type="search" name="search" id="search" class="search" placeholder="Search">
            </form>

            <a  class="writer" href="write.php"><p class="write">Write</p> <img class="writing" src="../Accessories/writing.png" alt="writing"></a>
        </header>


        <div class="dropdown">
		<button class="profile-button"> <img class="userprofile" src="../Accessories/face_FILL1_wght100_GRAD-25_opsz48.png" alt=""></button>
        <img class="expand" src="../Accessories/expand_more_FILL0_wght100_GRAD-25_opsz48.png" alt="">
		<div class="dropdown-content">
			<a href="editProfile.php"> <img src="../Accessories/profile icon.png" alt=""> Profile</a>
			<a href="articles.php"> <img src="../Accessories/stories.png" alt=""> Stories</a>
			<a href="settings.php"> <img src="../Accessories/gear.png" alt=""> Settings</a>
			<a href="../procFiles/logout_proc.php"> <img src="../Accessories/logout_FILL1_wght100_GRAD-25_opsz48.png" alt=""> Sign out</a>
		</div>
	    </div>
    </div>

    <div class="body">

    </div>

    <?php 

    // trending articles (articles with the most views)
    $sql = "SELECT Published.title, Published.subtitle, Published.feature_image, DATE(time_published) as date_published, count(Views.published_id) as no_of_views
    FROM Published, Views
    WHERE Published.published_id = Views.published_id
    GROUP BY Views.published_id
    ORDER BY no_of_views DESC";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // put the article's attributes in an array

    while ($row= mysqli_fetch_assoc($result)) {

            $title = $row['title'];
            $subtitle = $row['subtitle'];
            $feature_image = $row['feature_image'];
            $date_published = $row['date_published'];
            ?>

            <!-- html display -->
            <div class = "article">
            <div class="articlecontent">
            <p class="title"><?php echo $title . ": ". $subtitle;?><p>
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
    



</body>
</html>