<?php 
$page_title = "Register";
include 'header.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $username = $_POST['username']; 
    $email = $_POST['email']; 
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
    $sql = 'INSERT INTO users (username, email, password) VALUES (?, ?, ?)'; 
    $stmt = mysqli_prepare($conn, $sql); 
    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $password); 
    if(mysqli_stmt_execute($stmt)) { 
        $success = 'Registration successful! You can now <a href="login.php">login</a>.'; 
    } else { 
        $error = 'Registration failed. Username or email might already exist.'; 
    } 
} 
?>

<div class="container">
    <div class="card form-container">
        <h2>Create a New Account</h2>
        <?php 
        if(isset($error)) echo "<div class='alert alert-error'>$error</div>"; 
        if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; 
        ?>
        <form method='POST'>
            <input type='text' name='username' placeholder='Username' required>
            <input type='email' name='email' placeholder='Email' required>
            <input type='password' name='password' placeholder='Password' required>
            <button type='submit' class='btn'>Register</button>
        </form>
        <p style="text-align:center; margin-top: 20px;">
            Already have an account? <a href='login.php'>Login here</a>
        </p>
    </div>
</div>

<?php include 'footer.php'; ?>
