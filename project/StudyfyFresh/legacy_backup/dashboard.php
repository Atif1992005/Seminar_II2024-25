<?php 
$page_title = "Dashboard";
include 'header.php'; 

if(!isLoggedIn()) {
    redirect('login.php');
}
?>
<div class="container">
    <div class="card" style="margin-bottom: 30px;">
        <h2 style="margin-top:0;">Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <p>This is your central hub for academic success. What would you like to do today?</p>
    </div>

    <div class="grid">
        <div class="card">
            <div class="icon"><i class="fas fa-book-open"></i></div>
            <h3> Study Notes</h3>
            <p>Access comprehensive notes for all your subjects.</p>
            <a href='notes.php' class='btn'>View Notes</a>
        </div>
        <div class="card">
            <div class="icon"><i class="fas fa-question-circle"></i></div>
            <h3> Quizzes</h3>
            <p>Test your knowledge and prepare for exams.</p>
            <a href='quizzes.php' class='btn'>Take a Quiz</a>
        </div>
        <div class="card">
            <div class="icon"><i class="fas fa-tasks"></i></div>
            <h3> To-Do List</h3>
            <p>Organize your study schedule and manage your tasks.</p>
            <a href='todo.php' class='btn'>Manage Tasks</a>
        </div>
        <div class="card">
            <div class="icon"><i class="fas fa-lightbulb"></i></div>
            <h3> Study Tips</h3>
            <p>Discover new strategies to study more effectively.</p>
            <a href='study_tips.php' class='btn'>Get Tips</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
