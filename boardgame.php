<?php
session_start();

include 'config.php';

$message = array();

if (isset($_GET['id'])) {
    $boardgame_id = $_GET['id'];

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    }

    $select_query = mysqli_query($conn, "SELECT * FROM boardgame WHERE id = '$boardgame_id'");
    if (mysqli_num_rows($select_query) > 0) {
        $boardgame_data = mysqli_fetch_assoc($select_query);
    } else {
        $message[] = "A társasjáték nem található.";
    }

    $comments_query = mysqli_query($conn, "SELECT comment.*, user_form.name AS author_name FROM comment JOIN user_form ON comment.User_ID = user_form.ID WHERE comment.boardgame_id = '$boardgame_id'");
    $comments = array();
    while ($row = mysqli_fetch_assoc($comments_query)) {
        $comments[] = $row;
    }
} else {
    $message[] = "Nincs megadott társasjáték azonosító.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $boardgame_id = $_POST['boardgame_id'];
    $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);

    $insert_query = mysqli_query($conn, "INSERT INTO comment (User_ID, Boardgame_ID, Comment_Text) VALUES ('$user_id', '$boardgame_id', '$comment_text')");
    if ($insert_query) {
        $message[] = "Sikeres hozzászólás!";
    } else {
        $message[] = "Hiba történt a hozzászólás beküldése közben: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($boardgame_data['name']) ? $boardgame_data['name'] : 'Társasjáték'; ?></title>
    <style>
        <?php include 'style.css'; ?>
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        function downloadPDF() {
            const content = document.getElementById('boardgame-content');
            const doc = new jsPDF();

            html2canvas(content, {
                scale: 2, // Increase the scale to improve the quality
            }).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 190; // Width in mm
                const pageHeight = 285; // Height in mm (A4 paper)
                const imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;

                doc.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                doc.save('<?php echo isset($boardgame_data['name']) ? $boardgame_data['name'] : 'Boardgame'; ?>.pdf');
            });
        }
    </script>
</head>
<body>
<?php include 'navbar.php'; ?>
<script>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    window.location.replace(window.location.href);
    <?php endif; ?>
</script>
<div class="form-container">
    <div class="bg-main" >
        <div id="boardgame-content">
            <h3><?php echo isset($boardgame_data['name']) ? $boardgame_data['name'] : 'Név nincs megadva'; ?></h3>
            <?php if (!empty($boardgame_data['image'])): ?>
                <img src="uploaded_img/boardgames/<?php echo $boardgame_data['image']; ?>" class="boardgame-size-img">
            <?php endif; ?>
            <?php foreach ($message as $msg): ?>
                <div class="message"><?php echo $msg; ?></div>
            <?php endforeach; ?>
            <p><?php echo isset($boardgame_data['description']) ? $boardgame_data['description'] : 'Nincs leírás megadva.'; ?></p>
            <div class="bg-data-small">
                <p><?php echo isset($boardgame_data['minplayer']) && isset($boardgame_data['maxplayer']) ? $boardgame_data['minplayer'] . " - " . $boardgame_data['maxplayer'] . " Játékos" : 'Nincs megadva játékos létszám.'; ?></p>
                <p><?php echo isset($boardgame_data['playtime']) ? $boardgame_data['playtime'] . " játékidő" : 'Nincs megadva játékidő.'; ?></p>
            </div>
        </div>
        <button class="btn" onclick="downloadPDF()">Download as PDF</button>

        <div class="comment-section">
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li class="comment">
                        <div class="comment-line">
                            <span class="comment-author"><?php echo $comment['author_name']; ?></span>
                            <span class="comment-date">Dátum: <?php echo $comment['Created_at']; ?></span>
                        </div>
                        <span class="comment-text"><?php echo $comment['Comment_Text']; ?></span>
                        <?php if ($comment['Edited']): ?>
                            <span class="comment-author">(Szerkesztve)</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="comment-post-contanier">
                    <form class="comment-post-form" action="" method="post" enctype="multipart/form-data">
                        <input class="comment-input" type="text" name="comment_text"
                               placeholder="Írj egy hozzászólást...">
                        <input type="hidden" name="boardgame_id"
                               value="<?php echo isset($boardgame_id) ? $boardgame_id : ''; ?>">
                        <button class="btn" type="submit">Hozzászólás</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
