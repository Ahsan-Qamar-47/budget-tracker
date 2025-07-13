<?php
// Database actions (connect, insert, update, delete, fetch)

function db_connect() {
    $host = 'localhost';
    $user = 'root'; // Change if your MySQL user is different
    $pass = '';
    $db = 'Budget_Tracker';
    $conn = new mysqli($host, $user, $pass, $db);
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }
    return $conn;
}

function register_user($username, $email, $password) {
    $conn = db_connect();
    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $check = $conn->query("SELECT id FROM users WHERE username='$username' OR email='$email'");
    if ($check && $check->num_rows > 0) {
        $conn->close();
        return 'Username or email already exists.';
    }

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hash')";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        $error = $conn->error;
        $conn->close();
        return 'Registration failed: ' . $error;
    }
}

function login_user($username, $password) {
    $conn = db_connect();
    $username = $conn->real_escape_string($username);
    // Allow login with username or email
    $sql = "SELECT * FROM users WHERE username='$username' OR email='$username' LIMIT 1";
    $result = $conn->query($sql);
    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $conn->close();
            return $user;
        }
    }
    $conn->close();
    return false;
}

function get_user_expenses($user_id) {
    $conn = db_connect();
    $user_id = (int)$user_id;
    $expenses = [];
    $sql = "SELECT * FROM expenses WHERE user_id = $user_id ORDER BY expense_date DESC, id DESC";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $expenses[] = $row;
        }
    }
    $conn->close();
    return $expenses;
}

function add_expense($user_id, $title, $amount, $category, $expense_date) {
    $conn = db_connect();
    $user_id = (int)$user_id;
    $title = $conn->real_escape_string($title);
    $amount = floatval($amount);
    $category = $conn->real_escape_string($category);
    $expense_date = $conn->real_escape_string($expense_date);
    $sql = "INSERT INTO expenses (user_id, title, amount, category, expense_date) VALUES ($user_id, '$title', $amount, '$category', '$expense_date')";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        return true;
    } else {
        $error = $conn->error;
        $conn->close();
        return 'Failed to add expense: ' . $error;
    }
}

function get_total_spent($user_id) {
    $conn = db_connect();
    $user_id = (int)$user_id;
    $sql = "SELECT SUM(amount) as total FROM expenses WHERE user_id = $user_id";
    $result = $conn->query($sql);
    $total = 0;
    if ($result && $row = $result->fetch_assoc()) {
        $total = $row['total'] ?? 0;
    }
    $conn->close();
    return $total;
} 