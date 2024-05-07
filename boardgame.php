<?php
session_start();

include 'config.php';

$message = array();

if (isset($_GET['id'])) {
    $boardgame_id = $_GET['id'];
    $select_query = mysqli_query($conn, "SELECT * FROM boardgame WHERE id = '$boardgame_id'");
    if(mysqli_num_rows($select_query) > 0){
        $boardgame_data = mysqli_fetch_assoc($select_query);
    } else {
        $message[] = "Társasjáték nem található";
    }
} else {
    $message[] = "Nincs megadott társasjáték ID";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $boardgame_data['name']; ?></title>
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3><?php echo $boardgame_data['name']; ?></h3>
        <?php

        if ($boardgame_data['image'] == '') {
            echo '<img src="images/nobg.png" class="img-circle">';
        } else {
            echo '<img src="uploaded_img/boardgames/' . $boardgame_data['image'] . '" class=boardgame-size-img>';
        }
        if(isset($message)){
            foreach($message as $msg){
                echo '<div class="message">'.$msg.'</div>';
            }
        }
        ?>
        <p  ><?php echo $boardgame_data['description']; ?></p>
        <p> <?php echo $boardgame_data['minplayer']. " - ". $boardgame_data['maxplayer'] ." Játékos"; ?></p>
        <p> <?php echo $boardgame_data['playtime']." játékidő"; ?></p>
    </form>
</div>
</body>
</html>
