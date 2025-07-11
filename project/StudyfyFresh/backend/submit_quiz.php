<?php
session_start();
header('Content-Type: application/json');
require_once '../config.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}
$data = json_decode(file_get_contents('php://input'), true);
$quiz_id = intval($data['quiz_id'] ?? 0);
$answers = $data['answers'] ?? [];
if (!$quiz_id || !is_array($answers)) {
    echo json_encode(['success' => false, 'message' => 'Invalid data.']);
    exit;
}
// Fetch correct answers
$qResult = $conn->query("SELECT id, correct_option FROM questions WHERE quiz_id = $quiz_id");
$score = 0;
$total = 0;
while ($q = $qResult->fetch_assoc()) {
    $total++;
    $qid = $q['id'];
    if (isset($answers[$qid]) && strtolower($answers[$qid]) === strtolower($q['correct_option'])) {
        $score++;
    }
}
// Save result to quiz_results
$user_id = $_SESSION['user_id'] ?? 1;
$stmt = $conn->prepare('INSERT INTO quiz_results (user_id, quiz_id, score, total_questions, completed_at) VALUES (?, ?, ?, ?, NOW())');
$stmt->bind_param('iiii', $user_id, $quiz_id, $score, $total);
$stmt->execute();
echo json_encode(['success' => true, 'score' => $score, 'total' => $total]); 