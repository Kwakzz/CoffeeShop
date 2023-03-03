<?php

session_start();

if (isset($_REQUEST['search'])) {

    $search_item = $_REQUEST['search'];


    // connect to database
    include ('../helperFunctions/dbConnect.php');

    // search query
    $sql = "SELECT Published.title, Published.subtitle, Published.feature_image, Subscribers.fname, Subscribers.lname 
    FROM Published, Subscribers 
    WHERE title LIKE '%$search_item%' 
    AND Published.subscriber_id = Subscribers.subscriber_id 
    ORDER BY Published.time_published";

    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);


    // echo search results
    while ($row = mysqli_fetch_assoc($result)) {
        $title = $row['title'];
        $subtitle = $row['subtitle'];
        $feature_image = $row['feature_image'];
        $fname = $row['fname'];
        $lname = $row['lname'];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffeeshop</title>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@500&family=Dancing+Script:wght@700&family=Gideon+Roman&family=IBM+Plex+Sans:wght@200;300&family=Inter:wght@100;200&family=Lusitana&family=Source+Serif+Pro:wght@300&display=swap" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/editProfile.css">
</head>
<body>

    <div>
        <p><?php echo $title; ?></p>
        <p><?php echo $subtitle; ?></p>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['feature_image']); ?>"/>
        <p><?php echo $fname; ?></p>
        <p><?php echo $lname; ?></p>
    </div>

</body>
</html>


<?php } 
}
?>
