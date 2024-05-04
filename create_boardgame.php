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

if ( $admin_status != 1) {
    header("location: index.php");
    exit;}

$message = array();

if(isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $minplayer = mysqli_real_escape_string($conn, $_POST['minplayer']);
    $maxplayer = mysqli_real_escape_string($conn, $_POST['maxplayer']);
    $playtime = mysqli_real_escape_string($conn, $_POST['playtime']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/boardgames/' . $image;

    $select = mysqli_query($conn, "SELECT * FROM `boardgame` WHERE name = '$name'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $message[] = 'Már létezik ilyen nevű társasjáték!';
    } else {
        $max_image_size = 2 * 1024 * 1024;
        if($image_size > $max_image_size){
            $message[] = 'A képméret túl nagy (maximum 2MB)!';
        } else {
            if ( $admin_status = 1) {
            $insert_query = "INSERT INTO boardgame (name, description, minplayer, maxplayer, playtime, image) VALUES ('$name', '$description', '$minplayer', '$maxplayer', '$playtime', '$image')";
            $result = mysqli_query($conn, $insert_query);

            }else{
                header("location: index.php");
                exit;}

            if($result) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = "A társasjáték sikeresen hozzá lett adva!";
            } else {
                $message[] = "Hiba történt a társasjáték hozzáadása közben: " . mysqli_error($conn);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Board Game</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Create New Board Game</h3>
        <?php
        if(isset($message)){
            foreach($message as $msg){
                echo '<div class="message">'.$msg.'</div>';
            }
        }
        ?>
        <input type="text" name="name" placeholder="Name" required class="box">
        <textarea name="description" placeholder="Description" rows="4" required class="box"></textarea>
        <input type="number" name="minplayer" placeholder="Minimum Players" required class="box">
        <input type="number" name="maxplayer" placeholder="Maximum Players" required class="box">
        <input type="text" name="playtime" placeholder="Playtime" required class="box">
        <input type="file" name="image" accept="image/jpeg, image/png" required class="box">
        <input type="submit" name="submit" value="Add Board Game" class="btn">
    </form>
</div>
</body>
</html>
