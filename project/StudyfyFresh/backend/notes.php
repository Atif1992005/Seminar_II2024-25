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
    $result = $conn->query('SELECT id, subject, title, content, created_at FROM notes ORDER BY created_at DESC');
    $notes = [];
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
    echo json_encode(['success' => true, 'notes' => $notes]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $subject = trim($data['subject'] ?? 'General');
    $title = trim($data['title'] ?? 'Untitled');
    $content = trim($data['content'] ?? '');
    if (!$content) {
        echo json_encode(['success' => false, 'message' => 'Note content required.']);
        exit;
    }
    $stmt = $conn->prepare('INSERT INTO notes (subject, title, content, created_at) VALUES (?, ?, ?, NOW())');
    $stmt->bind_param('sss', $subject, $title, $content);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'note' => ['id' => $stmt->insert_id, 'subject' => $subject, 'title' => $title, 'content' => $content, 'created_at' => date('Y-m-d H:i:s')]]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add note.']);
    }
    exit;
}
echo json_encode(['success' => false, 'message' => 'Invalid request.']); 