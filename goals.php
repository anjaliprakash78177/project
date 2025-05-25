<?php
session_start();
include 'config.php';

if (!isset($_SESSION['username']) || !isset($_SESSION['partner_name'])) {
    $_SESSION['username'] = 'testuser';
    $_SESSION['partner_name'] = 'testpartner';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_SESSION['username'];
    $partner = $_SESSION['partner_name'];
    $goal = trim($_POST['goal']);

    if (!empty($goal)) {
        $stmt = $conn->prepare("INSERT INTO shared_goals (user, partner, goal) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $partner, $goal);
        $stmt->execute();
    }
}


$user = $_SESSION['username'];
$partner = $_SESSION['partner_name'];
$result = $conn->prepare("SELECT * FROM shared_goals WHERE user = ? AND partner = ? ORDER BY created_at DESC");
$result->bind_param("ss", $user, $partner);
$result->execute();
$goals = $result->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>💖 Shared Goals 💖</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #e0f7fa;
        margin: 0;
        padding: 20px;
    }

    h2 {
        text-align: center;
        color: #006064;
        margin-bottom: 20px;
    }

    form {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }

    form input, form button {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
        font-size: 16px;
    }

    form button {
        background: #006064;
        color: white;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
    }

    form button:hover {
        background: #004d40;
    }

    .goals {
        max-width: 700px;
        margin: auto;
    }

    .goal-item {
        background: white;
        padding: 15px;
        margin-bottom: 15px;
        border-left: 4px solid #006064;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .goal-item p {
        margin: 0;
    }

    .goal-item small {
        color: gray;
    }

</style>
</head>
<body>

<h2>🌿 Our Shared Goals 🌿</h2>

<form method="post">
    <input type="text" name="goal" placeholder="Enter a new shared goal..." required />
    <button type="submit">Add Goal</button>
</form>

<div class="goals">
    <?php while ($row = $goals->fetch_assoc()): ?>
        <div class="goal-item">
            <p>💬 <?php echo htmlspecialchars($row['goal']); ?></p>
            <small>Added on: <?php echo htmlspecialchars($row['created_at']); ?></small>
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
