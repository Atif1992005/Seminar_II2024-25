<?php 
$page_title = "Welcome to Studyfy";
include 'header.php'; 
?>

<div class="welcome-container">
    <h1>Welcome to Studyfy Fresh!</h1>
    <p>Your new study portal is ready to conquer academics!</p>
    <div>
        <?php if(isLoggedIn()): ?>
            <a href='dashboard.php' class='btn'>Go to Dashboard</a>
        <?php else: ?>
            <a href='login.php' class='btn'>Login</a>
            <a href='register.php' class='btn btn-secondary'>Register</a>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
