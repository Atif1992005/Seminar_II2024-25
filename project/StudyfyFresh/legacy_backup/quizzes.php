<?php 
$page_title = "Available Quizzes";
include 'header.php'; 

if(!isLoggedIn()) {
    redirect('login.php');
}

$quizzes_query = "SELECT q.id, q.title, q.subject, COUNT(qn.id) as question_count FROM quizzes q LEFT JOIN questions qn ON q.id = qn.quiz_id GROUP BY q.id ORDER BY q.subject, q.title";
$quizzes_result = mysqli_query($conn, $quizzes_query);
?>

<div class="container">
    <div class="card" style="margin-bottom: 30px;">
        <h2 style="margin-top:0;">Available Quizzes</h2>
        <p>Select a quiz to test your knowledge. Good luck!</p>
    </div>

    <div class="grid">
    <?php if(mysqli_num_rows($quizzes_result) > 0): ?>
        <?php while($quiz = mysqli_fetch_assoc($quizzes_result)): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($quiz['title']); ?></h3>
                <p><strong>Subject:</strong> <?php echo htmlspecialchars($quiz['subject']); ?></p>
                <p><?php echo $quiz['question_count']; ?> Questions</p>
                <a href='take_quiz.php?id=<?php echo $quiz['id']; ?>' class='btn'>Start Quiz</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No quizzes are available at the moment. Please check back later.</p>
    <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
