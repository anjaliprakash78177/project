<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location:register.php');
    exit();
}

$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $entry = mysqli_real_escape_string($conn, $_POST['entry']);

    $sql = "INSERT INTO diary (user_id, title, entry) VALUES ('$user_id', '$title', '$entry')";
    if (mysqli_query($conn, $sql)) {
        $message = "💖 Entry saved!";
    } else {
        $message = "❌ Error saving entry.";
    }
}

$entries = mysqli_query($conn, "SELECT * FROM diary WHERE user_id = '$user_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Love Diary</title>
    <style>
        body {
            background: linear-gradient(135deg, #ffdde1, #f3d1f4);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .diary-container {
            max-width: 700px;
            margin: auto;
            background: #fff0f5;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.4);
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0px); }
        }
        h2, h3 {
            color: #d6336c;
            text-align: center;
        }
        form {
            margin-bottom: 30px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ffb6c1;
            border-radius: 10px;
            margin-bottom: 15px;
            background: #fff;
        }
        button {
            background: #ff85a2;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #ff5c8a;
        }
        .diary-entry {
            background: #fff;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(255, 182, 193, 0.3);
        }
        .diary-entry strong {
            color: #ff4d6d;
            font-size: 1.1em;
        }
        .diary-entry small {
            color: #888;
            font-size: 0.9em;
        }
        .diary-entry p {
            color: #333;
            line-height: 1.4em;
        }
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
        @media (max-width: 600px) {
            .diary-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="diary-container">
        <h2>Your Love Diary 💖</h2>

        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>

        <form method="POST">
            <input type="text" name="title" placeholder="Entry Title" required>
            <textarea name="entry" placeholder="Write your romantic thoughts here..." required></textarea>
            <button type="submit">Save Entry</button>
        </form>

        <h3>Your Past Entries 🌸</h3>
        <?php while ($row = mysqli_fetch_assoc($entries)) { ?>
            <div class="diary-entry">
                <strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
                <small><?php echo $row['created_at']; ?></small>
                <p><?php echo nl2br(htmlspecialchars($row['entry'])); ?></p>
            </div>
        <?php } ?>
    </div>
    <!-- Back to Home button fixed at bottom center -->
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
