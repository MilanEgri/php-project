<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit;
}

include 'config.php';

$user_id = $_SESSION['user_id'];
$select_admin = mysqli_query($conn, "SELECT admin FROM `user_form` WHERE id = '$user_id'");
$row = mysqli_fetch_assoc($select_admin);
$admin_status = $row['admin'];

if ($admin_status != 1) {
    header("location: index.php");
    exit;
}

$message = array();

if(isset($_POST['submit'])) {
    $boardgame_id = $_GET['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $minplayer = mysqli_real_escape_string($conn, $_POST['minplayer']);
    $maxplayer = mysqli_real_escape_string($conn, $_POST['maxplayer']);
    $playtime = mysqli_real_escape_string($conn, $_POST['playtime']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/boardgames/' . $image;

    $max_image_size = 2 * 1024 * 1024; // 2MB
    if ($image_size > $max_image_size) {
        $message[] = 'Képméret túl nagy(maximum 2MB).';
    } else {
        $update_query = "UPDATE boardgame SET name = '$name', description = '$description', minplayer = '$minplayer', maxplayer = '$maxplayer', playtime = '$playtime'";

        if (!empty($image)) {
            $update_query .= ", image = '$image'";
        }

        $update_query .= " WHERE id = '$boardgame_id'";

        $result = mysqli_query($conn, $update_query);

        if($result) {
            if (!empty($image)) {
                move_uploaded_file($image_tmp_name, $image_folder);
            }
            $message[] = "Társasjáték sikeresen frissítve";
        } else {
            $message[] = "Valmi hiba történt: " . mysqli_error($conn);
        }
    }
}

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
    <title>Edit Board Game</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Edit Board Game</h3>
        <?php
        if(isset($message)){
            foreach($message as $msg){
                echo '<div class="message">'.$msg.'</div>';
            }
        }
        ?>
        <input type="text" name="name" placeholder="Name" value="<?php echo $boardgame_data['name']; ?>" required class="box">
        <textarea name="description" placeholder="Description" rows="4" required class="box"><?php echo $boardgame_data['description']; ?></textarea>
        <input type="text" name="minplayer" placeholder="Minimum Players" value="<?php echo $boardgame_data['minplayer']; ?>" required class="box">
        <input type="text" name="maxplayer" placeholder="Maximum Players" value="<?php echo $boardgame_data['maxplayer']; ?>" required class="box">
        <input type="text" name="playtime" placeholder="Playtime" value="<?php echo $boardgame_data['playtime']; ?>" required class="box">
        <input type="file" name="image" accept="image/jpeg, image/png" class="box">
        <input type="submit" name="submit" value="Update Board Game" class="btn">
    </form>
</div>
</body>
</html>
