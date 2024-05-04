<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include 'config.php';
$user_id = $_SESSION['user_id'];
$select_admin = mysqli_query($conn, "SELECT admin FROM `user_form` WHERE id = '$user_id'");
$row = mysqli_fetch_assoc($select_admin);
$admin_status = $row['admin'];

if ($admin_status != 1) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$boardgame_id = $_GET['id'];

$delete_query = mysqli_query($conn, "DELETE FROM boardgame WHERE id = '$boardgame_id'");

if ($delete_query) {
    header("Location: index.php");
    exit;
} else {
    $_SESSION['error'] = "A Társasjáték törlése nem sikerül.";
    header("Location: index.php");
    exit;
}
?>
