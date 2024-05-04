<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['delete_profile'])){
    mysqli_query($conn, "DELETE FROM `user_form` WHERE id = '$user_id'") or die('query failed');
    unset($user_id);
    session_destroy();
    header('location:register.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

    <style>
        <?php include 'style.css'; ?>
    </style>

</head>
<body>
<?php include 'navbar.php'; ?>

<div class="container">

    <div class="profile">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
        }
        if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png" class="img-circle">';
        }else{
            echo '<img src="uploaded_img/profile/'.$fetch['image'].'" class="img-circle">';
        }
        ?>
        <h3><?php echo $fetch['name']; ?></h3>
        <a href="update_profile.php" class="btn">Profil frissítése</a>
        <form action="" method="post">
            <input type="submit" name="delete_profile" value="Profil Törlése" class="delete-btn">
        </form>

        <a href="logout.php" class="delete-btn">Kilépés</a>    </div>

</div>

</body>
</html>
