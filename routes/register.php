<?php
require_once "../includes/database.php";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first = $_POST['first_name'];
    $last  = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone_number'];
    $dob   = $_POST['date_of_birth'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $image = 'default.jpg'; // ยังไม่อัปโหลดรูป

    $conn = getConnection();
    $stmt = $conn->prepare("
        INSERT INTO students 
        (first_name, last_name, email, phone_number, date_of_birth, image, password)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssssss",
        $first, $last, $email, $phone, $dob, $image, $password
    );

    if ($stmt->execute()) {
        header("Location: /login");
        exit;
    }

    $error = "สมัครสมาชิกไม่สำเร็จ";
}

require "../templates/register.php";
