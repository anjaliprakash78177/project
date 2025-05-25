<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: register.php');
    exit();
}

$sql = "SELECT title, artist, language, youtube_id FROM songs WHERE youtube_id != '' ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Mood Songs 🎵 (Online Streaming)</title>
<style>
    body {
        background: linear-gradient(135deg, #fceabb, #f8b500);
        font-family: Arial, sans-serif;
        margin: 0; padding: 20px;
        color: #4a2c00;
    }
    .container {
        max-width: 900px;
        margin: auto;
        background: #fff8e1;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 0 25px rgba(248, 181, 0, 0.6);
    }
    h2 {
        text-align: center;
        color: #d35400;
        margin-bottom: 30px;
    }
    .song {
        margin-bottom: 30px;
        padding: 15px;
        background: #ffefc1;
        border-radius: 12px;
        box-shadow: 0 0 15px rgba(211, 84, 0, 0.5);
    }
    .song h3 {
        margin: 0 0 8px;
        font-weight: 700;
    }
    .song p {
        margin: 0 0 15px;
        font-style: italic;
    }
    iframe {
        width: 100%;
        height: 180px;
        border: none;
        border-radius: 10px;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Romantic Mood Songs 🎵 (YouTube Streaming)</h2>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="song">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p>Artist: <?= htmlspecialchars($row['artist']) ?> | Language: <?= htmlspecialchars($row['language']) ?></p>
                <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($row['youtube_id']) ?>?rel=0" allowfullscreen></iframe>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No songs available at the moment.</p>
    <?php endif; ?>
</div>
<a href="home.php" style="
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background: #b33a6c;
    color: white;
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
    font-size: 16px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: background 0.3s ease;
    z-index: 1000;
" onmouseover="this.style.background='#d94a7d'" onmouseout="this.style.background='#b33a6c'">
    ⬅ Back to Home
</a>

</body>
</html>
