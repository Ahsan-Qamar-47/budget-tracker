<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'includes/header.php';
require_once 'db_actions.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_expense'])) {
    $title = trim($_POST['title'] ?? '');
    $amount = floatval($_POST['amount'] ?? 0);
    $category = trim($_POST['category'] ?? '');
    $expense_date = $_POST['expense_date'] ?? '';
    if (!$title || !$amount || !$expense_date) {
        $message = 'Title, amount, and date are required.';
    } else {
        $result = add_expense($_SESSION['user_id'], $title, $amount, $category, $expense_date);
        if ($result === true) {
            header('Location: view_expense.php');
            exit();
        } else {
            $message = $result;
        }
    }
}

$expenses = get_user_expenses($_SESSION['user_id']);
?>
<main>
    <h2>Your Expenses</h2>
    <button onclick="window.print()" class="print-btn">Print</button>
    <h3>Add New Expense</h3>
    <?php if ($message): ?>
        <p style="color:red;"> <?= $message ?> </p>
    <?php endif; ?>
    <form method="post" action="">
        <input type="hidden" name="add_expense" value="1">
        <label>Title: <input type="text" name="title" required></label>
        <label>Amount: <input type="number" step="0.01" name="amount" required></label>
        <label>Category: <input type="text" name="category"></label>
        <label>Date: <input type="date" name="expense_date" required></label>
        <button type="submit">Add Expense</button>
    </form>
    <br>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($expenses && count($expenses) > 0): ?>
                <?php foreach ($expenses as $exp): ?>
                    <tr>
                        <td><?= htmlspecialchars($exp['title']) ?></td>
                        <td><?= number_format($exp['amount'], 2) ?></td>
                        <td><?= htmlspecialchars($exp['category']) ?></td>
                        <td><?= htmlspecialchars($exp['expense_date']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">No expenses found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>
<?php include 'includes/footer.php'; ?> 