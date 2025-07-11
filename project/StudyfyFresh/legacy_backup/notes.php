<?php 
$page_title = "Study Notes";
include 'header.php'; 

if(!isLoggedIn()) {
    redirect('login.php');
}

// Fetch subjects for the filter dropdown
$subjects_query = "SELECT DISTINCT subject FROM notes ORDER BY subject ASC";
$subjects_result = mysqli_query($conn, $subjects_query);

// Filter logic
$selected_subject = $_GET['subject'] ?? 'All';
$notes_query = "SELECT * FROM notes";
if ($selected_subject != 'All') {
    $notes_query .= " WHERE subject = ?";
}
$notes_query .= " ORDER BY created_at DESC";

$stmt = mysqli_prepare($conn, $notes_query);
if ($selected_subject != 'All') {
    mysqli_stmt_bind_param($stmt, "s", $selected_subject);
}
mysqli_stmt_execute($stmt);
$notes_result = mysqli_stmt_get_result($stmt);
?>

<div class="container">
    <div class="card" style="margin-bottom: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin-top:0;">Study Notes</h2>
            <form method="GET" action="notes.php">
                <select name="subject" onchange="this.form.submit()" style="padding: 10px; border-radius: 8px; border: 1px solid #ddd;">
                    <option value="All" <?php if($selected_subject == 'All') echo 'selected'; ?>>All Subjects</option>
                    <?php while($row = mysqli_fetch_assoc($subjects_result)): ?>
                        <option value="<?php echo htmlspecialchars($row['subject']); ?>" <?php if($selected_subject == $row['subject']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($row['subject']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </form>
        </div>
    </div>

    <?php if(mysqli_num_rows($notes_result) > 0): ?>
        <?php while($note = mysqli_fetch_assoc($notes_result)): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($note['title']); ?> <span style="font-size: 0.9rem; color: #777; background: #f0f2f5; padding: 5px 10px; border-radius: 15px;"><?php echo htmlspecialchars($note['subject']); ?></span></h3>
                <div class="note-content">
                    <?php echo $note['content']; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="card">
            <p>No notes found for the selected subject. Why not be the first to add one?</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
