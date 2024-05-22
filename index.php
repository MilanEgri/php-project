<?php
session_start();
include 'config.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$select_admin = mysqli_query($conn, "SELECT admin FROM `user_form` WHERE id = '$user_id'");
$row = mysqli_fetch_assoc($select_admin);
$admin_status = isset($row['admin']) ? $row['admin'] : 0;

// Pagination logic
$limit = 8; // Number of items per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

$total_results = mysqli_query($conn, "SELECT COUNT(*) as total FROM boardgame");
$total_row = mysqli_fetch_assoc($total_results);
$total_boardgames = $total_row['total'];
$total_pages = ceil($total_boardgames / $limit);

$result = mysqli_query($conn, "SELECT id, name, image FROM boardgame LIMIT $offset, $limit");
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
        echo "<a class='btn-medium btn-medium' href='create_boardgame.php'> Új Társasjáték </a>";
    }
    ?>
    <h2>Társas Játékok</h2>
    <div id="boardgameList">
        <?php
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
                    echo "<a class='delete-btn-small' href='delete.php?id={$row['id']}'> Törlés </a>";
                    echo "<a class='delete-btn-small blue' href='edit_boardgame.php?id={$row['id']}'> Szerkeztés </a>";
                    echo "</div>";
                }
                echo "</div>";
            }
        } else {
            echo "Nincsenek társasjátékok.";
        }
        ?>
    </div>
    <div class="pagination">
        <?php
        if ($page > 1) {
            echo '<a href="?page=' . ($page - 1) . '">Előző</a>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            if ($i == $page) {
                echo '<span class="current-page">' . $i . '</span>';
            } else {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
        }

        if ($page < $total_pages) {
            echo '<a href="?page=' . ($page + 1) . '">Következő</a>';
        }
        ?>
    </div>
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
