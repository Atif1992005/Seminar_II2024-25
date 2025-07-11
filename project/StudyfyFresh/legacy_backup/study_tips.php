<?php
$page_title = "Study Tips";
include 'header.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

// Fetch all study tips, ordered by category
$tips_query = "SELECT * FROM study_tips ORDER BY category, title";
$tips_result = mysqli_query($conn, $tips_query);
?>

<div class="container">
    <div class="card" style="margin-bottom: 30px;">
        <h2 style="margin-top:0;">Effective Study Tips</h2>
        <p>Browse our collection of tips to improve your learning habits, manage your time, and prepare for exams.</p>
    </div>

    <?php
    $current_category = "";
    if (mysqli_num_rows($tips_result) > 0):
        while ($tip = mysqli_fetch_assoc($tips_result)):
            // Display category header if it's a new category
            if ($tip['category'] !== $current_category) {
                if ($current_category !== "") {
                    echo '</div>'; // Close previous grid
                }
                $current_category = $tip['category'];
                echo "<h3 style='margin-left: 10px; margin-bottom: 15px; color: #764ba2;'>$current_category</h3>";
                echo '<div class="grid" style="margin-bottom: 30px;">';
            }
    ?>
            <div class="card">
                <h4 style="margin-top:0;"><?php echo htmlspecialchars($tip['title']); ?></h4>
                <div class="tip-content">
                    <?php echo $tip['content']; ?>
                </div>
            </div>
    <?php
        endwhile;
        echo '</div>'; // Close the last grid
    else:
    ?>
        <div class="card">
            <p>No study tips are available at the moment. Please check back later.</p>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
