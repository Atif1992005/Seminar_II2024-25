<?php 
$page_title = "Login";
include 'header.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    $sql = 'SELECT * FROM users WHERE username = ?'; 
    $stmt = mysqli_prepare($conn, $sql); 
    mysqli_stmt_bind_param($stmt, 's', $username); 
    mysqli_stmt_execute($stmt); 
    $result = mysqli_stmt_get_result($stmt); 
    if($user = mysqli_fetch_assoc($result)) { 
        if(password_verify($password, $user['password'])) { 
            $_SESSION['user_id'] = $user['id']; 
            $_SESSION['username'] = $user['username']; 
            redirect('dashboard.php'); 
        } else { 
            $error = 'Invalid password'; 
        } 
    } else { 
        $error = 'User not found'; 
    } 
} 
?>

<div class="container">
    <div class="card form-container">
        <h2>Login to your Account</h2>
        <?php if(isset($error)) echo "<div class='alert alert-error'>$error</div>"; ?>
        <form method='POST'>
            <input type='text' name='username' placeholder='Username' required>
            <input type='password' name='password' placeholder='Password' required>
            <button type='submit' class='btn'>Login</button>
        </form>
        <p style="text-align:center; margin-top: 20px;">
            Don't have an account? <a href='register.php'>Register here</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
