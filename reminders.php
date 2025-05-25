<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'testuser'; 
}

$user = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reminder = trim($_POST['reminder']);
    $remind_at = $_POST['remind_at'];

    if (!empty($reminder) && !empty($remind_at)) {
        $stmt = $conn->prepare("INSERT INTO reminders (user, reminder, remind_at) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $reminder, $remind_at);
        $stmt->execute();
    }
}


$stmt = $conn->prepare("SELECT * FROM reminders WHERE user = ? ORDER BY remind_at ASC");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>⏰ My Reminders</title>
<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        background: #f0f4c3;
        padding: 20px;
        margin: 0;
    }
    h2 {
        text-align: center;
        color: #827717;
    }
    form {
        max-width: 600px;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    input[type=text], input[type=datetime-local] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        font-size: 16px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
    button {
        background: #827717;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 4px;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
        margin-top: 10px;
    }
    button:hover {
        background: #558b2f;
    }
    .reminder-list {
        max-width: 600px;
        margin: 20px auto;
    }
    .reminder-item {
        background: white;
        padding: 15px;
        border-left: 5px solid #827717;
        margin-bottom: 15px;
        border-radius: 5px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }
    .reminder-date {
        color: #a1887f;
        font-size: 14px;
        margin-top: 5px;
    }
</style>
</head>
<body>

<h2>⏰ My Reminders</h2>

<form method="post" autocomplete="off">
    <input type="text" name="reminder" placeholder="What do you want to be reminded about?" required />
    <input type="datetime-local" name="remind_at" required />
    <button type="submit">Add Reminder</button>
</form>

<div class="reminder-list">
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="reminder-item">
            <div><?php echo htmlspecialchars($row['reminder']); ?></div>
            <div class="reminder-date">Remind at: <?php echo htmlspecialchars(date('d M Y, h:i A', strtotime($row['remind_at']))); ?></div>
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
