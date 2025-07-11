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
    $result = $conn->query('SELECT id, task, is_completed, created_at FROM todos ORDER BY is_completed ASC, created_at DESC');
    $todos = [];
    while ($row = $result->fetch_assoc()) {
        $todos[] = $row;
    }
    echo json_encode(['success' => true, 'todos' => $todos]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['complete'])) {
        $todo_id = intval($data['complete']);
        $stmt = $conn->prepare('UPDATE todos SET is_completed = NOT is_completed WHERE id = ?');
        $stmt->bind_param('i', $todo_id);
        $stmt->execute();
        echo json_encode(['success' => true]);
        exit;
    }
    if (isset($data['delete'])) {
        $todo_id = intval($data['delete']);
        $stmt = $conn->prepare('DELETE FROM todos WHERE id = ?');
        $stmt->bind_param('i', $todo_id);
        $stmt->execute();
        echo json_encode(['success' => true]);
        exit;
    }
    $task = trim($data['task'] ?? '');
    if (!$task) {
        echo json_encode(['success' => false, 'message' => 'Task required.']);
        exit;
    }
    $stmt = $conn->prepare('INSERT INTO todos (task) VALUES (?)');
    $stmt->bind_param('s', $task);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'todo' => ['id' => $stmt->insert_id, 'task' => $task, 'is_completed' => 0]]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add todo.']);
    }
    exit;
}
echo json_encode(['success' => false, 'message' => 'Invalid request.']); 