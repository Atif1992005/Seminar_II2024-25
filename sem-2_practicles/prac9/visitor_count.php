<?php
// Name: Atif Ali Khan
// Roll No: 167
// Class: SY-A

// Define the file to store the visitor count
$visitor_count_file = 'visitor_count.txt';

// Check if the file exists, if not create it and initialize the count
if (!file_exists($visitor_count_file)) {
    file_put_contents($visitor_count_file, 0);
}

// Read the current count from the file
$current_count = (int)file_get_contents($visitor_count_file);

// Increment the count
$current_count++;

// Write the new count back to the file
file_put_contents($visitor_count_file, $current_count);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Counter</title>
</head>
<body>
    <h1>Welcome to Our Website!</h1>
    <p>Number of visitors: <?php echo htmlspecialchars($current_count); ?></p>
</body>
</html>
