<?php
session_start();
include 'config.php';
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'testuser'; 
}

$user = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['item'])) {
    $item = trim($_POST['item']);
    $stmt = $conn->prepare("INSERT INTO wishlist (user, item) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $item);
    $stmt->execute();
}


$stmt = $conn->prepare("SELECT * FROM wishlist WHERE user = ? ORDER BY created_at DESC");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>🌟 My Wishlist</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #fff3e0;
        margin: 0; padding: 20px;
    }
    h2 {
        text-align: center;
        color: #bf360c;
    }
    form {
        max-width: 500px;
        margin: 20px auto;
        background: white;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    input[type=text] {
        width: 100%;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        font-size: 16px;
    }
    button {
        margin-top: 10px;
        width: 100%;
        padding: 10px;
        background: #bf360c;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 4px;
    }
    button:hover {
        background: #e64a19;
    }
    .item-list {
        max-width: 500px;
        margin: 20px auto;
    }
    .item {
        background: white;
        margin-bottom: 10px;
        padding: 12px;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    .date {
        color: gray;
        font-size: 12px;
    }
</style>
</head>
<body>

<h2>🌟 My Wishlist</h2>

<form method="post">
    <input type="text" name="item" placeholder="Add a new wishlist item..." required />
    <button type="submit">Add to Wishlist</button>
</form>

<div class="item-list">
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="item">
            <div><?php echo htmlspecialchars($row['item']); ?></div>
            <div class="date">Added on: <?php echo htmlspecialchars($row['created_at']); ?></div>
        </div>
    <?php endwhile; ?>
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
