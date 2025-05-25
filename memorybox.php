<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login_register.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle memory upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['memory_image'])) {
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $image = $_FILES['memory_image']['name'];
    $target = "uploads/" . basename($image);

    if (move_uploaded_file($_FILES['memory_image']['tmp_name'], $target)) {
        $sql = "INSERT INTO memorybox (user_id, image, description) VALUES ('$user_id', '$image', '$desc')";
        if (mysqli_query($conn, $sql)) {
            $message = "🌸 Memory saved!";
        } else {
            $message = "❌ Error saving memory.";
        }
    } else {
        $message = "❌ Error uploading file.";
    }
}

// Fetch all memories
$memories = mysqli_query($conn, "SELECT * FROM memorybox WHERE user_id = '$user_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Memory Box</title>
    <style>
        body {
            background: linear-gradient(135deg, #fbc2eb, #a6c1ee);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .memory-container {
            max-width: 900px;
            margin: auto;
            background: #fffafa;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 25px rgba(255, 182, 193, 0.5);
        }
        h2, h3 {
            text-align: center;
            color: #ff6f91;
        }
        form {
            margin-bottom: 30px;
            text-align: center;
        }
        input[type="file"], textarea {
            display: block;
            margin: 10px auto;
            padding: 12px;
            width: 80%;
            border: 1px solid #ffb6c1;
            border-radius: 10px;
        }
        button {
            background: #ff85a2;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background: #ff5c8a;
        }
        .memory-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 15px;
        }
        .memory-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(255, 182, 193, 0.3);
            text-align: center;
            padding: 10px;
        }
        .memory-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .memory-card p {
            margin-top: 10px;
            color: #555;
            font-size: 0.9em;
        }
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
        @media (max-width: 600px) {
            input[type="file"], textarea {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <div class="memory-container">
        <h2>Memory Box 📸</h2>

        <?php if (isset($message)) echo "<p class='message'>$message</p>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="memory_image" required>
            <textarea name="description" placeholder="Write a sweet memory note..." required></textarea>
            <button type="submit">Save Memory</button>
        </form>

        <h3>Your Saved Memories 💕</h3>
        <div class="memory-gallery">
            <?php while ($row = mysqli_fetch_assoc($memories)) { ?>
                <div class="memory-card">
                    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Memory Image">
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                </div>
            <?php } ?>
        </div>
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
