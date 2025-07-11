<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in.']);
    exit;
}
require_once '../config.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}

$quiz_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($quiz_id > 0) {
    // Fetch quiz by id
    $stmt = $conn->prepare('SELECT * FROM quizzes WHERE id = ?');
    $stmt->bind_param('i', $quiz_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $quiz = $result->fetch_assoc();
    if (!$quiz) {
        echo json_encode(['success' => false, 'message' => 'Quiz not found.']);
        exit;
    }
    $quiz_id = $quiz['id']; // Ensure $quiz_id is set
} else {
    // Fetch a random quiz
    $result = $conn->query('SELECT * FROM quizzes ORDER BY RAND() LIMIT 1');
    $quiz = $result->fetch_assoc();
    if (!$quiz) {
        echo json_encode(['success' => false, 'message' => 'No quiz found.']);
        exit;
    }
    $quiz_id = $quiz['id'];
}

$questions = [];
$qResult = $conn->query("SELECT id, question_text, option_a, option_b, option_c, option_d FROM questions WHERE quiz_id = $quiz_id");
while ($q = $qResult->fetch_assoc()) {
    $questions[] = $q;
}
echo json_encode(['success' => true, 'quiz' => ['id' => $quiz_id, 'title' => $quiz['title'], 'questions' => $questions]]); 