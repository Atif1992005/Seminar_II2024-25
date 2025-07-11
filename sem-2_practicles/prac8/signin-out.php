<?php
// Name: Atif Ali Khan
// Roll No: 167
// Class: SY-A
// Exp: Write a PHP program to implement sign-In and Sign-out functionality.

session_start();

$validUsername = "admin";
$validPassword = "1234";

// Handle Logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['username'] = $username;
        header("Location: login.php");
        exit;
    }
}

$isLoggedIn = isset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            background-color: #d0e7f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #ffffff;
            width: 340px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #003366;
        }
        p.username {
            font-size: 18px;
            color: #555;
            margin-top: 0;
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        .button {
            padding: 10px 20px;
            background-color: #7ec8e3;
            border: none;
            border-radius: 6px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .button:hover {
            background-color: #57a4c7;
        }
        .footer-logout {
            position: fixed;
            background-color: #57a4c7;
            bottom: 20px;
            width: 100%;
            text-align: center;
            padding: 10px 0;
        }
        form {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($isLoggedIn): ?>
            <h2>Welcome!</h2>
            <p class="username"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
        <?php else: ?>
            <h2>Sign In</h2>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" class="button">Sign In</button>
            </form>
        <?php endif; ?>
    </div>

    <?php if ($isLoggedIn): ?>
        <div class="footer-logout">
            <a href="?logout=true" class="button">Sign Out</a>
        </div>
    <?php endif; ?>
</body>
</html>
