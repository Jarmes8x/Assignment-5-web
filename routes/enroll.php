<?php
session_start();
require_once "../includes/database.php";

$student_id = $_SESSION['student_id'];
$course_id = $_POST['course_id'];

$conn = getConnection();
$stmt = $conn->prepare(
    "INSERT INTO enrollment (student_id, course_id) VALUES (?, ?)"
);
$stmt->bind_param("ii", $student_id, $course_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "ลงทะเบียนสำเร็จ";
}
header("Location: /courses");
