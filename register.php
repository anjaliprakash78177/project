<?php
session_start();
include'config.php';
$success = false;  
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $your_name = $_POST['your_name'];
    $partner_name = $_POST['partner_name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (your_name, partner_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $your_name, $partner_name, $email, $pass);

    if ($stmt->execute()) {
        $success = true;
    }
    $stmt->close();
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - PremDiary</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ffe6f0, #fad6e8);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(180, 120, 140, 0.4);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #b33a6c;
            margin-bottom: 10px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
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
            margin-top: 10px;
        }
        button:hover {
            background: #d94a7d;
        }
        .footer {
            margin-top: 10px;
        }
        .footer a {
            color: #b33a6c;
            text-decoration: none;
        }
        .success-message {
            color: green;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to PremDiary</h2>
        <h3>Register your love</h3>

        <?php if ($success): ?>
            <div class="success-message">
                Registration successful! You can now <a href="login.php">log in</a>.
            </div>
        <?php else: ?>
            <form method="post">
                <input type="text" name="your_name" placeholder="Your Name" required>
                <input type="text" name="partner_name" placeholder="Partner's Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁</span>
                </div>
                <button type="submit">Register</button>
            </form>
            <div class="footer">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function togglePassword() {
            var pass = document.getElementById('password');
            if (pass.type === 'password') {
                pass.type = 'text';
            } else {
                pass.type = 'password';
            }
        }
    </script>
</body>
</html>