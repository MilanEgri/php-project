<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
    exit;
}



include 'config.php';
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

    $old_pass = $_POST['old_pass'];
    $update_pass= mysqli_real_escape_string($conn, md5($_POST['update_pass']));

    if(!empty($_POST['new_pass'])){
    $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
    }else{
        $new_pass = null;
    }
    if(!empty($_POST['confirm_pass'])){

    $confirm_pass= mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));
    }else{
        $confirm_pass= null;
    }

    if(!empty($new_pass) || !empty($confirm_pass)){
        if($update_pass != $old_pass){
            echo "<script>console.log('$new_pass');</script>";
            echo "<script>console.log('$confirm_pass');</script>";
            $message[] = 'Jelenlegi jelszó hibás!';
        }elseif($new_pass != $confirm_pass){
            $message[] = 'Jeleszók nem egyeznek!';
        }else{
            mysqli_query($conn, "UPDATE `user_form` SET password = '$confirm_pass' WHERE id = '$user_id'") or die('query failed');
            $message[] = 'Jelszó sikeresen frissítve!';
        }
    }

    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/profile/'.$update_image;

    if(!empty($update_image)){
        if($update_image_size > 2000000){
            $message[] = 'Képméret túl nagy';
        }else{
            $image_update_query = mysqli_query($conn, "UPDATE `user_form` SET image = '$update_image' WHERE id = '$user_id'") or die('query failed');
            if($image_update_query){
                move_uploaded_file($update_image_tmp_name, $update_image_folder);
            }
            $message[] = 'Kép sikeresen feltöltve!';
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Frisítése</title>

    <style>
        <?php include 'style.css'; ?>
    </style>

</head>
<body>
<?php include 'navbar.php'; ?>

<div class="update-profile">

    <?php
    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select) > 0){
        $fetch = mysqli_fetch_assoc($select);
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <?php
        if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
        }else{
            echo '<img src="uploaded_img/profile/'.$fetch['image'].'">';
        }
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
            }
        }
        ?>
        <div class="flex">
            <div class="inputBox">
                <span>Felhasználónév :</span>
                <input type="text" name="update_name" value="<?php echo $fetch['name']; ?>" class="box" disabled>
                <span>email cím:</span>
                <input type="email" name="update_email" value="<?php echo $fetch['email']; ?>" class="box" disabled>
                <span>profil kép frissítése :</span>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
            </div>
            <div class="inputBox">
                <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
                <span>Jelenlegi jelszó:</span>
                <input type="password" name="update_pass" placeholder="Jelenlegi jelszó" class="box">
                <span>Új jelszó:</span>
                <input type="password" name="new_pass" placeholder="Új jelszó" class="box">
                <span>Jelszó megerősítése:</span>
                <input type="password" name="confirm_pass" placeholder="Jelszó megerősítése" class="box">
            </div>
        </div>
        <input type="submit" value="Profil frissítése" name="update_profile" class="btn">
        <a href="home.php" class="delete-btn">Vissza</a>
    </form>

</div>

</body>
</html>
