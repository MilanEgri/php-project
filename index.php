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
    <style>
        <?php include 'style.css'; ?>
    </style>
</head>

<body>
<?php include 'navbar.php'; ?>
<div class="search-container">
    <input type="text" class="searchInput" id="searchBar" placeholder="Társasjáték keresése"
           onkeyup="filterBoardGames()">
</div>
<div class="container boardgame-contanier">
    <?php
    if ($admin_status == 1) {
        echo "<a class=btn-medium btn-medium  href='create_boardgame.php'> Új Társasjáték </a>";
    }
    ?>
    <h2>Társas Játékok</h2>
    <div id="boardgameList">
        <?php
        $result = mysqli_query($conn, "SELECT id, name, image FROM boardgame");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='boardgame'>";
                if ($row['image'] == "") {
                    echo '<img src=images/nobg.png class="boardgame-image">';
                } else {
                    echo "<img src='uploaded_img/boardgames/{$row['image']}' alt='{$row['name']}' class='boardgame-image'>";
                }
                echo "<a href='boardgame.php?id={$row['id']}'>{$row['name']}</a>";
                if ($admin_status == 1) {
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
        <div>
        </div>

        <script>
            function filterBoardGames() {
                const input = document.getElementById('searchBar').value.toLowerCase();
                const boardgameList = document.getElementById('boardgameList');
                const boardgames = boardgameList.getElementsByClassName('boardgame');

                Array.from(boardgames).forEach(boardgame => {
                    const name = boardgame.getElementsByTagName('a')[0].textContent.toLowerCase();
                    if (name.includes(input)) {
                        boardgame.style.display = '';
                    } else {
                        boardgame.style.display = 'none';
                    }
                });
            }
        </script>

</body>

</html>
