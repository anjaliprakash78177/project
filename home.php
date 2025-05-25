<?php
session_start();
$yourName = $_SESSION['your_name'] ?? 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PremDiary - Home</title>
<style>
    body, html {
        height: 100%;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #fff;
    }
    body {
        background: linear-gradient(135deg, #ffdde1 0%, #ee9ca7 100%);
        background-size: cover;
        overflow-x: hidden;
    }

    /* Floating hearts animation */
    .heart {
        position: fixed;
        width: 30px;
        height: 30px;
        background: url('https://cdn-icons-png.flaticon.com/512/833/833472.png') no-repeat center;
        background-size: contain;
        animation: floatUp 10s linear infinite;
        opacity: 0.7;
    }
    @keyframes floatUp {
        0% { transform: translateY(100vh); opacity: 0; }
        50% { opacity: 0.8; }
        100% { transform: translateY(-10vh); opacity: 0; }
    }

    /* Navigation */
    nav {
        background: purple;
        padding: 12px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 3px 7px rgba(214, 51, 108, 0.9);
        border-radius: 0 0 15px 15px;
    }
    .logo {
        font-size: 26px;
        font-weight: 900;
        color: #fff;
        text-shadow: 0 0 7px #ffa6c9;
        margin-bottom: 10px;
        text-align: center;
    }
    ul.nav-links {
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 0;
        padding: 0;
        justify-content: center;
        width: 100%;
    }
    ul.nav-links li a {
        color: white;
        text-decoration: none;
        font-weight: 600;
        padding: 8px 14px;
        border-radius: 6px;
        transition: background 0.3s ease;
        white-space: nowrap;
        background: rgba(255, 255, 255, 0.1);
    }
    ul.nav-links li a:hover {
        background: #ffa6c9;
        color: #4b004b;
        box-shadow: 0 0 10px #ffa6c9;
    }

    .welcome-msg {
         margin: 40px auto 30px;
        max-width: 700px;
        font-size: 26px;
        font-style: italic;
        text-align: center;
        color: purple;
    }

    .quote-section {
        max-width: 650px;
        margin: 0 auto 60px;
        padding: 20px 30px;
        background: lightgreen;
        border-radius: 15px;
        font-size: 20px;
        font-style: italic;
        color: green;
    }

    @media (max-width: 768px) {
        nav {
            padding: 10px;
        }
        .logo {
            font-size: 22px;
        }
        .welcome-msg {
            font-size: 20px;
        }
        .quote-section {
        
            font-size: 18px;
            margin: 0 15px 40px;
            padding: 15px 20px;
        }
        
    }
    @media (max-width: 480px) {
        ul.nav-links {
            flex-direction: column;
        }
        ul.nav-links li a {
            width: 100%;
            text-align: center;
        }
    }
</style>
</head>
<body>

<nav>
    <div class="logo">PremDiary 💖</div>
    <ul class="nav-links">
        <li><a href="home.php">Home</a></li>
        <li><a href="diary.php">Love Diary</a></li>
        <li><a href="memorybox.php">Memory Box</a></li>
        <li><a href="futuremsg.php">Future Message</a></li>
        <li><a href="songplayer.php">Mood Songs</a></li>
        <li><a href="goals.php">Shared Goals</a></li>
        <li><a href="wishlist.php">Wishlist</a></li>
        <li><a href="reminders.php">Reminders</a></li>
        <li><a href="love_calculator.php">Love Calculator</a></li>
        <li><a href="quiz.php">Love Quiz</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>

<div class="welcome-msg">
    Welcome, <strong><?php echo htmlspecialchars($yourName); ?></strong>! 💞<br>
    Your journey of love starts here. Explore all the beautiful features.
</div>

<div class="quote-section">
    "Love is not about how many days, months, or years you have been together. <br>
    It’s about how much you love each other every single day." 💖
</div>

<!-- Floating hearts -->
<script>
    for (let i = 0; i < 20; i++) {
        let heart = document.createElement('div');
        heart.className = 'heart';
        heart.style.left = Math.random() * 100 + 'vw';
        heart.style.animationDuration = (5 + Math.random() * 5) + 's';
        document.body.appendChild(heart);
    }
</script>

</body>
</html>
