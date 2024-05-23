<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select) > 0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['admin'] = $row['admin'];
        header('location:home.php');
    }else{
        $message[] = 'Hibás felhasználónév vagy jelszó!';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belépés</title>

    <style>
        <?php include 'style.css'; ?>
    </style>

</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">

    <form action="" method="post" enctype="multipart/form-data">
        <h3>Belépés</h3>
        <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<div class="message">'.$message.'</div>';
            }
        }
        ?>
        <input type="email" name="email" placeholder="email cím" class="box" required>
        <input type="password" name="password" placeholder="jelszó" class="box" required>
        <input type="submit" name="submit" value="Belépés" class="btn">
        <p>Még nincs profilod? <a href="register.php">Regisztráció</a></p>
    </form>

</div>

</body>
</html>