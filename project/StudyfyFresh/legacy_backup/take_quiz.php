<?php 
$page_title = "Take Quiz";
include 'header.php'; 

if(!isLoggedIn()) {
    redirect('login.php');
}

if (!isset($_GET['id'])) {
    redirect('quizzes.php');
}

$quiz_id = $_GET['id'];

// Fetch quiz details
$quiz_q = mysqli_prepare($conn, "SELECT * FROM quizzes WHERE id = ?");
mysqli_stmt_bind_param($quiz_q, "i", $quiz_id);
mysqli_stmt_execute($quiz_q);
$quiz = mysqli_stmt_get_result($quiz_q)->fetch_assoc();

// Fetch questions for the quiz
$questions_q = mysqli_prepare($conn, "SELECT * FROM questions WHERE quiz_id = ?");
mysqli_stmt_bind_param($questions_q, "i", $quiz_id);
mysqli_stmt_execute($questions_q);
$questions = mysqli_stmt_get_result($questions_q);
?>

<style>
.quiz-question { margin-bottom: 25px; padding: 20px; border: 1px solid #eee; border-radius: 8px; }
.quiz-options label { display: block; margin-bottom: 10px; padding: 10px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s; }
.quiz-options label:hover { background-color: #f0f2f5; }
.quiz-options input { margin-right: 10px; }
</style>

<div class="container">
    <div class="card">
        <h2><?php echo htmlspecialchars($quiz['title']); ?></h2>
        <p><strong>Subject:</strong> <?php echo htmlspecialchars($quiz['subject']); ?></p>

        <form action="quiz_result.php" method="POST">
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
            <?php $q_num = 1; while($question = mysqli_fetch_assoc($questions)): ?>
            <div class="quiz-question">
                <p><strong>Question <?php echo $q_num++; ?>:</strong> <?php echo htmlspecialchars($question['question_text']); ?></p>
                <div class="quiz-options">
                    <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="a" required> A) <?php echo htmlspecialchars($question['option_a']); ?></label>
                    <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="b"> B) <?php echo htmlspecialchars($question['option_b']); ?></label>
                    <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="c"> C) <?php echo htmlspecialchars($question['option_c']); ?></label>
                    <label><input type="radio" name="answers[<?php echo $question['id']; ?>]" value="d"> D) <?php echo htmlspecialchars($question['option_d']); ?></label>
                </div>
            </div>
            <?php endwhile; ?>
            <button type="submit" class="btn">Submit Answers</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
