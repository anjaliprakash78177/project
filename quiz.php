<?php
$score = 0;
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = true;
    
    $answers = $_POST['q'] ?? [];

    
    $correct_answers = [
        1 => 'b',  
        2 => 'a',  
        3 => 'c',  
        4 => 'b',  
        5 => 'a'   
    ];

    foreach ($correct_answers as $q => $ans) {
        if (isset($answers[$q]) && $answers[$q] === $ans) {
            $score++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Love Quiz</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #ffe6e6;
        display: flex;
        justify-content: center;
        padding: 40px;
    }
    .quiz-container {
        background: white;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 0 15px #ff6f91;
        width: 450px;
    }
    h2 {
        text-align: center;
        color: #d6336c;
    }
    form {
        margin-top: 20px;
    }
    .question {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-top: 6px;
        cursor: pointer;
        font-weight: 500;
    }
    input[type=radio] {
        margin-right: 10px;
    }
    button {
        background: #d6336c;
        color: white;
        padding: 12px 0;
        width: 100%;
        border: none;
        border-radius: 7px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 10px;
    }
    button:hover {
        background: #a0274e;
    }
    .result {
        background: #ffd6e8;
        border: 2px solid #d6336c;
        border-radius: 10px;
        padding: 15px;
        margin-top: 20px;
        text-align: center;
        font-weight: 600;
        font-size: 20px;
        color: #b32e5f;
    }
</style>
</head>
<body>
<div class="quiz-container">
    <h2>Love Compatibility Quiz</h2>

    <?php if (!$submitted): ?>
    <form method="post" action="">
        <div class="question">
            <strong>1. How do you show love?</strong>
            <label><input type="radio" name="q[1]" value="a" required> By buying gifts</label>
            <label><input type="radio" name="q[1]" value="b"> Always romantic gestures</label>
            <label><input type="radio" name="q[1]" value="c"> By spending time alone</label>
        </div>

        <div class="question">
            <strong>2. What’s most important in a relationship?</strong>
            <label><input type="radio" name="q[2]" value="a" required> Trust</label>
            <label><input type="radio" name="q[2]" value="b"> Money</label>
            <label><input type="radio" name="q[2]" value="c"> Appearance</label>
        </div>

        <div class="question">
            <strong>3. What’s the best date idea?</strong>
            <label><input type="radio" name="q[3]" value="a" required> Dinner at a fancy restaurant</label>
            <label><input type="radio" name="q[3]" value="b"> Watching movies at home</label>
            <label><input type="radio" name="q[3]" value="c"> Surprise picnic</label>
        </div>

        <div class="question">
            <strong>4. How do you handle fights?</strong>
            <label><input type="radio" name="q[4]" value="a" required> Ignore and avoid</label>
            <label><input type="radio" name="q[4]" value="b"> Talk and listen carefully</label>
            <label><input type="radio" name="q[4]" value="c"> Shout and argue</label>
        </div>

        <div class="question">
            <strong>5. How often do you express your feelings?</strong>
            <label><input type="radio" name="q[5]" value="a" required> Openly and often</label>
            <label><input type="radio" name="q[5]" value="b"> Only when asked</label>
            <label><input type="radio" name="q[5]" value="c"> Rarely or never</label>
        </div>

        <button type="submit">See My Love Score</button>
    </form>

    <?php else: ?>
        <div class="result">
            Your Love Compatibility Score is: <?= $score ?>/5 <br>
            <?php
            if ($score == 5) {
                echo "Perfect match! You’re a true romantic ❤️";
            } elseif ($score >= 3) {
                echo "Good vibes! Your love is strong 😊";
            } else {
                echo "Work a little more on your love skills 😉";
            }
            ?>
        </div>
        <button onclick="window.location.href='<?= $_SERVER['PHP_SELF'] ?>'">Try Again</button>
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
