<?php
session_start();
header('Content-Type: application/json');
require_once '../config.php';
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed.']);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $conn->query('SELECT q.id, q.title, q.subject, q.created_at, COUNT(DISTINCT qq.id) as question_count FROM quizzes q LEFT JOIN questions qq ON q.id = qq.quiz_id GROUP BY q.id ORDER BY q.subject, q.title');
    $quizzes = [];
    while ($row = $result->fetch_assoc()) {
        $quizzes[] = $row;
    }
    echo json_encode(['success' => true, 'quizzes' => $quizzes]);
    exit;
}
echo json_encode(['success' => false, 'message' => 'Invalid request.']); 