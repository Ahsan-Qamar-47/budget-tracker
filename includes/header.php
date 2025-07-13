<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracker</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <header>
        <h1>Budget Tracker</h1>
        <nav>
            <ul class="navbar">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="dashboard.php" class="<?= basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
                    <li><a href="view_expense.php" class="<?= basename($_SERVER['SCRIPT_NAME']) == 'view_expense.php' ? 'active' : '' ?>">View Expenses</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="<?= basename($_SERVER['SCRIPT_NAME']) == 'login.php' ? 'active' : '' ?>">Login</a></li>
                    <li><a href="registration.php" class="<?= basename($_SERVER['SCRIPT_NAME']) == 'registration.php' ? 'active' : '' ?>">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header> 