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
$tips_result = $conn->query('SELECT * FROM study_tips ORDER BY category, title');
$tips_by_category = [];
while ($tip = $tips_result->fetch_assoc()) {
    $cat = $tip['category'];
    if (!isset($tips_by_category[$cat])) {
        $tips_by_category[$cat] = [];
    }
    $tips_by_category[$cat][] = $tip;
}
echo json_encode(['success' => true, 'tips' => $tips_by_category]); 