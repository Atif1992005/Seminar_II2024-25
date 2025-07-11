<?php 
$page_title = "Quiz Result";
include 'header.php'; 

if(!isLoggedIn()) {
    redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('quizzes.php');
}

$quiz_id = $_POST['quiz_id'];
$answers = $_POST['answers'];
$user_id = $_SESSION['user_id'];
$score = 0;

$questions_q = mysqli_prepare($conn, "SELECT id, correct_option FROM questions WHERE quiz_id = ?");
mysqli_stmt_bind_param($questions_q, "i", $quiz_id);
mysqli_stmt_execute($questions_q);
$result = mysqli_stmt_get_result($questions_q);

$correct_answers = [];
while($row = mysqli_fetch_assoc($result)) {
    $correct_answers[$row['id']] = $row['correct_option'];
}

foreach ($answers as $question_id => $user_answer) {
    if (isset($correct_answers[$question_id]) && $user_answer === $correct_answers[$question_id]) {
        $score++;
    }
}

$total_questions = count($correct_answers);

// Save the result to the database
$insert_q = mysqli_prepare($conn, "INSERT INTO quiz_results (user_id, quiz_id, score, total_questions) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($insert_q, "iiii", $user_id, $quiz_id, $score, $total_questions);
mysqli_stmt_execute($insert_q);

?>

<div class="container">
    <div class="card" style="text-align: center;">
        <h2>Quiz Complete!</h2>
        <h3>Your Score: <span style="color: #667eea;"><?php echo $score; ?> out of <?php echo $total_questions; ?></span></h3>
        <p>Thank you for participating!</p>
        <a href="quizzes.php" class="btn">Try Another Quiz</a>
        <a href="dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
</div>

<?php include 'footer.php'; ?>
