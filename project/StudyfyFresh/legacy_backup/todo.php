<?php
$page_title = "To-Do List";
include 'header.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// Handle Add, Delete, and Toggle actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $stmt = mysqli_prepare($conn, "INSERT INTO todos (user_id, task) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "is", $user_id, $task);
        mysqli_stmt_execute($stmt);
        header("Location: todo.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $stmt = mysqli_prepare($conn, "DELETE FROM todos WHERE id = ? AND user_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $task_id, $user_id);
    mysqli_stmt_execute($stmt);
    header("Location: todo.php");
    exit();
}

if (isset($_GET['toggle'])) {
    $task_id = $_GET['toggle'];
    $stmt = mysqli_prepare($conn, "UPDATE todos SET is_completed = !is_completed WHERE id = ? AND user_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $task_id, $user_id);
    mysqli_stmt_execute($stmt);
    header("Location: todo.php");
    exit();
}

// Fetch user's tasks
$tasks_q = mysqli_prepare($conn, "SELECT * FROM todos WHERE user_id = ? ORDER BY is_completed ASC, created_at DESC");
mysqli_stmt_bind_param($tasks_q, "i", $user_id);
mysqli_stmt_execute($tasks_q);
$tasks_result = mysqli_stmt_get_result($tasks_q);
?>
<style>
.todo-list { list-style: none; padding: 0; }
.todo-item { display: flex; align-items: center; justify-content: space-between; padding: 15px; border-bottom: 1px solid #eee; }
.todo-item:last-child { border-bottom: none; }
.todo-item.completed span { text-decoration: line-through; color: #999; }
.todo-item a { text-decoration: none; margin-left: 10px; }
.todo-item .actions .toggle-btn { color: #28a745; }
.todo-item .actions .delete-btn { color: #dc3545; }
.add-task-form { display: flex; gap: 10px; }
.add-task-form input { flex-grow: 1; }
</style>
<div class="container">
    <div class="card">
        <h2>My To-Do List</h2>
        <p>Stay organized and keep track of your study tasks.</p>
        <form method="POST" class="add-task-form">
            <input type="text" name="task" placeholder="e.g., Read Chapter 5 of Physics" required>
            <button type="submit" name="add_task" class="btn">Add Task</button>
        </form>
    </div>

    <div class="card">
        <ul class="todo-list">
            <?php if (mysqli_num_rows($tasks_result) > 0): ?>
                <?php while ($task = mysqli_fetch_assoc($tasks_result)): ?>
                    <li class="todo-item <?php echo $task['is_completed'] ? 'completed' : ''; ?>">
                        <span><?php echo htmlspecialchars($task['task']); ?></span>
                        <div class="actions">
                            <a href="?toggle=<?php echo $task['id']; ?>" class="toggle-btn" title="Toggle status">
                                <i class="fas fa-<?php echo $task['is_completed'] ? 'undo' : 'check-circle'; ?>"></i>
                            </a>
                            <a href="?delete=<?php echo $task['id']; ?>" class="delete-btn" title="Delete task" onclick="return confirm('Are you sure you want to delete this task?');">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="todo-item">You have no pending tasks. Great job!</li>
            <?php endif; ?>
        </ul>
    </div>
</div>
<?php include 'footer.php'; ?>
