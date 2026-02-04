<?php
session_start();
require_once "../includes/database.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = getConnection();
    $stmt = $conn->prepare("
        SELECT student_id, first_name, last_name, password
        FROM students
        WHERE email = ?
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && $user['password'] && password_verify($password, $user['password'])) {
        $_SESSION['student_id'] = $user['student_id'];
        $_SESSION['student_name'] = $user['first_name'] . ' ' . $user['last_name'];
        header("Location: /courses");
        exit;
    }

    $error = "อีเมลหรือรหัสผ่านไม่ถูกต้อง";
}

require "../templates/login.php";
