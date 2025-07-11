<?php include_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Studyfy'; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php if (isLoggedIn()): ?>
    <header class="main-header">
        <a href="dashboard.php" class="logo">Studyfy</a>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="notes.php">Notes</a>
            <a href="quizzes.php">Quizzes</a>
            <a href="todo.php">To-Do List</a>
            <a href="study_tips.php">Study Tips</a>
            <a href="logout.php" class="btn btn-secondary">Logout</a>
        </nav>
    </header>
    <?php endif; ?>
    <main>
