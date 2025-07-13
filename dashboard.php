<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
require_once 'db_actions.php';
$total_spent = get_total_spent($_SESSION['user_id']);
include 'includes/header.php';
?>
<main>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <section>
        <h3>Summary</h3>
        <p>Total Spent: <strong><?= number_format($total_spent, 2) ?></strong></p>
    </section>
</main>
<?php include 'includes/footer.php'; ?> 