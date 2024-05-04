<?php

include 'config.php';

if(isset($_POST['submit'])){


    $recaptcha_response = $_POST['g-recaptcha-response'];

    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = array(
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response
    );

    $recaptcha_options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => http_build_query($recaptcha_data)
        )
    );

    $recaptcha_context = stream_context_create($recaptcha_options);
    $recaptcha_result = file_get_contents($recaptcha_url, false, $recaptcha_context);
    $recaptcha_json = json_decode($recaptcha_result, true);

    if($recaptcha_json['success'] == true){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $confirmPassword = mysqli_real_escape_string($conn, md5($_POST['confirmPassword']));
        $image = $_FILES['image']['name'];
        $image_size = $_FILES['image']['size'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'uploaded_img/profile/'.$image;

        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email'") or die('query failed');

        if(mysqli_num_rows($select) > 0){
            $message[] = 'A Felhasználónév Vagy Email foglalt';
        }else{
            if($pass != $confirmPassword){
                $message[] = 'Jelszók nem egyeznek!';
            }elseif($image_size > 2000000){
                $message[] = 'Képméret túl nagy';
            }else{
                $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');

                if($insert){
                    move_uploaded_file($image_tmp_name, $image_folder);
                    $message[] = 'Sikeres regisztráció!';
                    header('location:login.php');
                    exit;
                }else{
                    $message[] = 'Regisztráció nem sikerült!';
                }
            }
        }
    } else {
        $message[] = 'Pipáld be hogy nem vagy robot.';
    }
}

?>
<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Regisztráció</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body>
<?php include 'navbar.php'; ?>

<div class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Regisztrálj most</h3>
        <?php
        if(isset($message)){
            foreach($message as $msg){
                echo '<div class="message">'.$msg.'</div>';
            }
        }
        ?>
        <input type="text" name="name" placeholder="Felhasználónév" required class="box">
        <input type="email" name="email" placeholder="Email" required class="box">
        <input type="password" name="password" placeholder="Jelszó" required class="box">
        <input type="password" name="confirmPassword" placeholder="Jelszó megerősítése" required class="box">
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
        <div class="g-recaptcha" data-sitekey="6LcKQ8QpAAAAAPMchFOG-CtR_rnP06-HR57SW1Qe"></div>
        <input type="submit" name="submit" value="Regisztráció" class="btn">
        <p>Már van profilod? <a href="login.php">Belépés</a></p>
    </form>
</div>
</body>
</html>
