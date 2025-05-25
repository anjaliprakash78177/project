<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location:register.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msg_text = mysqli_real_escape_string($conn, $_POST['message']);
    $open_date = $_POST['open_date'];

    // Validate open_date (should be a future date)
    if (strtotime($open_date) > time()) {
        $sql = "INSERT INTO futmsgs (user_id, message, open_date) VALUES ('$user_id', '$msg_text', '$open_date')";
        if (mysqli_query($conn, $sql)) {
            $message = "💌 Future message saved!";
        } else {
            $message = "❌ Error saving message.";
        }
    } else {
        $message = "❌ Please select a future date.";
    }
}

// Fetch messages that are allowed to be read (open_date <= today)
$today = date('Y-m-d');
$result = mysqli_query($conn, "SELECT * FROM futmsgs WHERE user_id='$user_id' AND open_date <= '$today' ORDER BY open_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Future Messages</title>
    <style>
        body {
            background: linear-gradient(135deg, #fceabb, #f8b500);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 20px;
            color: #5a3e1b;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: #fff8e1;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(248, 181, 0, 0.5);
        }
        h2 {
            text-align: center;
            color: #f8b500;
        }
        form {
            margin-bottom: 30px;
            text-align: center;
        }
        textarea, input[type="date"] {
            width: 80%;
            padding: 12px;
            margin: 10px auto;
            border: 2px solid #f8b500;
            border-radius: 10px;
            font-size: 1em;
            display: block;
        }
        button {
            background: #f8b500;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 15px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #d99800;
        }
        .message {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            color: green;
        }
        .error {
            color: red;
        }
        .future-msg {
            background: #fff3b0;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 0 10px rgba(248, 181, 0, 0.3);
        }
        .date {
            font-style: italic;
            color: #a67800;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Future Messages 💌</h2>

        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST" autocomplete="off">
            <textarea name="message" placeholder="Write your future love message..." required rows="4"></textarea>
            <input type="date" name="open_date" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>" />
            <button type="submit">Save Message</button>
        </form>

        <h3>Your Available Messages</h3>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="future-msg">
                    <div class="date">Open Date: <?= htmlspecialchars($row['open_date']) ?></div>
                    <div><?= nl2br(htmlspecialchars($row['message'])) ?></div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No messages available to read yet. Write one for the future!</p>
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
