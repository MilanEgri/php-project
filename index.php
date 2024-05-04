<?php
session_start();

include 'config.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$select_admin = mysqli_query($conn, "SELECT admin FROM `user_form` WHERE id = '$user_id'");
$row = mysqli_fetch_assoc($select_admin);
$admin_status = isset($row['admin']) ? $row['admin'] : 0;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Project</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include 'navbar.php'; ?>

<div class="container boardgame-contanier">
    <?php
    if($admin_status ==1){
        echo "<a class=btn-medium btn-medium  href='create_boardgame.php'> Új Társasjáték </a>";
    }
    ?>
    <h2>Társas Játékok</h2>
    <?php
    $result = mysqli_query($conn, "SELECT id, name, image FROM boardgame");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='boardgame'>";
            echo "<img src='uploaded_img/boardgames/{$row['image']}' alt='{$row['name']}' class='boardgame-image'>";
            echo "<h3>{$row['name']}</h3>";
            if($admin_status ==1){
                echo "<div class='boardgame-btns'>";
                echo "<a class=delete-btn-small href='delete.php?id={$row['id']}'> Törlés </a>";
                echo "<a class='delete-btn-small blue' href='edit_boardgame.php?id={$row['id']}'> Szerkeztés </a>";
                echo "</div>";
            }
            echo "</div>";
        }
    } else {
        echo "Nincsenek társasjátékok.";
    }
    ?>
</div>

</body>

</html>
