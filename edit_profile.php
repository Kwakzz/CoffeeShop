<!--password:LoremIpsum1!-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="styles/edit_profile.css"/>
    <link rel="icon" href="images/coffee shop favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="images/coffee shop favicon.png" type="image/x-icon">  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=EB+Garamond&display=swap">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <title>Edit your profile</title>

</head>

<?php

    // start session
    session_start();

?>

<body>

    <!--retrieve user's data-->
    <?php

    include("helper_functions/db_connect.php");

    $session_id = $_SESSION['subscriber_id'];

    // query to fetch user's data
    $sql = "SELECT username, fname, lname, email_address, profile_pic, bio
    FROM Subscribers
    WHERE Subscribers.subscriber_id = '$session_id'";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    // put the user's attributes in an array
    while ($row= mysqli_fetch_assoc($result)) {

        $username = $row['username'];
        $email_address = $row['email_address'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $bio = $row['bio'];
        $profile_pic = $row['profile_pic'];

    ?>


    <!-- top header-->
     <div id="top_header">
        <!--logo-->
        <a href="index.php"><img id ="logo" src="images/coffee shop logo black.png"/></a>

        <!--search bar-->
        <form method="GET" action="search_results.php">
            <input id="search" name="keyword" type = "search" placeholder="Search article">
        </form>

        <!-- write icon -->
        <a href="write.php"><img alt="Write" id="write" src="images/write.png"/></a>

        <!-- profile pic dropdown -->
        <div class="dropdown">
            <!-- profile icon -->
            <img id="profile_pic" src = "<?php if ($profile_pic == NULL) {echo "images/default profile icon.jpeg";} else {echo "data:image/jpg;charset=utf8;base64,".base64_encode($row['profile_pic']);}?>"/>

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

    
    <!-- user details -->
    <form action="proc_files/edit_profile_proc.php" method="POST" id="edit_profile_form" enctype="multipart/form-data">
        <div class ="user_details">

            <!--email-->
            <div id= "email_address_div">
                <label for="email_address" class="text_input_label">Email address</label>
                <br>
                <input type="text" class="text_input" id="username" value='<?php echo $email_address; ?>' readonly>
            </div>
            <br>

            <!--profile pic-->
            <div id = "profile_pic_div">
                <label for = "my_profile_pic">Profile Pic </label>
                <br>
                <img id="my_profile_pic" src = "<?php if ($profile_pic == NULL) {echo "images/default profile icon.jpeg";} else {echo "data:image/jpg;charset=utf8;base64,".base64_encode($row['profile_pic']);}?>"/>
                <br>
                <input type="file" name="profile_pic" id="profile_pic_input" accept="image/*" onchange="loadFile(event)" style="display: none;">
                <p><label for="profile_pic_input" id="upload_image" style="cursor: pointer;">Upload Image</label></p>
            </div>
            <br>

            <!--username-->
            <div id= "username_div">
                <label for="username" class="text_input_label">Username</label>
                <br>
                <input type="text" name="username" class="text_input" id="username" value='<?php echo $username; ?>'>
            </div>
            <br>

            <!--bio-->
            <div id="bio_div">
                <label for="bio" class="text_input_label">Bio</label>
                <br>
                <input type="text" name="bio" class="text_input" id="bio" value='<?php echo $bio; ?>'>
            </div>

            <!--Cancel and Save buttons-->
            <div id="cancel_save_buttons">
                <input id="cancel_button" name="cancel" type="submit" value="Cancel">
                <input id="save_button" name="save" type="submit" value="Save">
            </div>

        </div>
    </form>
    


<?php

    }
?>
 
    <!--Link to javascript file containing change image function-->
    <script src="scripts/changeImage.js"></script>

    <!--Link to javascript file containing ajax for search-->
    <script src="scripts/search.js"></script>

    <!-- link to dropdown.js -->
    <script src="scripts/dropdown.js"></script>
</body>

</html>