<?php
session_start();
require_once "../includes/database.php";

$enrollment_id = $_POST['enrollment_id'];

$conn = getConnection();
$stmt = $conn->prepare("DELETE FROM enrollment WHERE enrollment_id = ?");
$stmt->bind_param("i", $enrollment_id);
$stmt->execute();

$_SESSION['success'] = "ถอนวิชาสำเร็จ";
header("Location: /courses");
