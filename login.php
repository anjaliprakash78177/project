<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['your_name'] = $user['your_name'];  // save name to session
            header("Location: home.php");
            exit;
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "No account found with this email!";
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - PremDiary</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ffe6f0, #fad6e8);
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(180, 120, 140, 0.4);
            width: 350px;
            z-index: 2;
            position: relative;
            animation: popIn 1s ease;
        }
        @keyframes popIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        h2 {
            color: #b33a6c;
            text-align: center;
            margin-bottom: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            outline: none;
            box-sizing: border-box;
        }
        .password-container {
            position: relative;
        }
        .password-container input {
            padding-right: 40px;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #b33a6c;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #b33a6c;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        button:hover {
            background: #d94a7d;
            transform: scale(1.05);
        }
        .footer {
            text-align: center;
            margin-top: 10px;
        }
        .footer a {
            color: #b33a6c;
            text-decoration: none;
        }
        .message {
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome Back to PremDiary</h2>
        <h3 style="text-align:center; color:#b33a6c;">Login to Continue</h3>
        <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required>
            <div class="password-container">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword()">👁</span>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="footer">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            var pass = document.getElementById('password');
            pass.type = (pass.type === 'password') ? 'text' : 'password';
        }
    </script>
</body>
</html>