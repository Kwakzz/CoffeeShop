<?php 

if (isset($_GET['published_id'])) {

    $published_id = $_GET['published_id'];

    include ('../helperFunctions/dbConnect.php');

    $sql = "SELECT Published.title, Published.subtitle, Published.time_published, Published.feature_image, Published.content, Subscribers.fname, Subscribers.lname
    FROM Published, Subscribers
    WHERE Published.published_id = $published_id AND Published.subscriber_id = Subscribers.subscriber_id";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $title = $row['title'];
        $subtitle = $row['subtitle'];
        $date = $row['DATE(time_published)'];
        $feature_image = $row['feature_image'];
        $content = $row['content'];
        $fname = $row['fname'];
        $lname = $row['lname'];

        ?>

        <p><?php echo $title;?></p>
        <p><?php echo $subtitle;?></p>
        <p><?php echo $date;?></p>
        <p><?php echo $fname;?></p>
        <p><?php echo $lname;?></p>
        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['feature_image']); ?>"/>
        <p><?php echo $content;?></p>
        
    <?php
    } 

}

?>
