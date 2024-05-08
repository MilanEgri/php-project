<?php
session_start();

include 'config.php';

$message = array();

if (isset($_GET['id'])) {
    $boardgame_id = $_GET['id'];

    // Lekérdezzük a társasjáték adatait
    $select_query = mysqli_query($conn, "SELECT * FROM boardgame WHERE id = '$boardgame_id'");
    if (mysqli_num_rows($select_query) > 0) {
        $boardgame_data = mysqli_fetch_assoc($select_query);
    } else {
        $message[] = "Társasjáték nem található";
    }

    // Lekérdezzük a hozzászólásokat
    $comments_query = mysqli_query($conn, "SELECT comment.*, user_form.name AS author_name FROM comment JOIN user_form ON comment.User_ID = user_form.ID WHERE comment.boardgame_id = '$boardgame_id'");
    $comments = array();
    while ($row = mysqli_fetch_assoc($comments_query)) {
        $comments[] = $row; // A teljes hozzászólás tömböt adjuk hozzá, nem csak a szöveget
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
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<div class="message">' . $msg . '</div>';
            }
        }
        ?>
        <p><?php echo $boardgame_data['description']; ?></p>
        <p><?php echo $boardgame_data['minplayer'] . " - " . $boardgame_data['maxplayer'] . " Játékos"; ?></p>
        <p><?php echo $boardgame_data['playtime'] . " játékidő"; ?></p>

        <div class="comment-section">
            <h4>Commentek:</h4>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li class="comment">
                        <div class="comment-line">
                            <span class="comment-author"><?php echo $comment['author_name']; ?></span>
                            <span class="comment-date">Dátum: <?php echo $comment['Created_at']; ?></span>
                        </div>
                        <p><?php echo $comment['Comment_Text']; ?></p>
                        <?php if ($comment['Edited']): ?>
                            <span class="comment-author">(Szerkesztve)</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </form>
</div>
</body>
</html>
