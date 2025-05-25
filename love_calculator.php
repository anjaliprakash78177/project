<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>💖 Love Calculator 💖</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #ffe6f2;
    margin: 0; padding: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }
  h1 {
    color: #d81b60;
  }
  form {
    background: white;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(216, 27, 96, 0.4);
    max-width: 350px;
    width: 100%;
  }
  input[type="text"] {
    width: 100%;
    padding: 12px 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 16px;
  }
  button {
    background: #d81b60;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 6px;
    width: 100%;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s;
  }
  button:hover {
    background: #ad1457;
  }
  .result {
    margin-top: 25px;
    font-size: 20px;
    font-weight: bold;
    color: #880e4f;
    text-align: center;
  }
</style>
</head>
<body>

<h1>💖 Love Calculator 💖</h1>

<form method="post">
  <input type="text" name="name1" placeholder="Your Name" required />
  <input type="text" name="name2" placeholder="Partner's Name" required />
  <button type="submit">Calculate Love %</button>
</form>

<div class="result">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name1 = strtolower(trim($_POST['name1']));
    $name2 = strtolower(trim($_POST['name2']));

    // Simple algorithm: sum of char codes mod 101 (0-100%)
    $combined = $name1 . $name2;
    $sum = 0;
    for ($i = 0; $i < strlen($combined); $i++) {
        $sum += ord($combined[$i]);
    }
    $lovePercent = $sum % 101;

    echo "💞 Love between <b>" . htmlspecialchars(ucfirst($name1)) . "</b> and <b>" . htmlspecialchars(ucfirst($name2)) . "</b> is: <br><br>";
    echo "<span style='font-size: 48px; color: #d81b60;'>$lovePercent%</span>";
}
?>
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
