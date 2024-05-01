<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>
<body>
<nav class="navbar">
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php
        if(isset($_SESSION['user_id'])) {
            echo '<li><a href="home.php">Profil</a></li>';
            echo '<li><a href="logout.php">Kilépés</a></li>';
        } else {
            echo '<li><a href="login.php">Belépés</a></li>';
            echo '<li><a href="register.php">Regisztráció</a></li>';
        }
        ?>
    </ul>
</nav>

</body>
</html>
