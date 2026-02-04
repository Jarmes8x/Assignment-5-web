<?php
session_start();
require_once "../includes/database.php";
require_once "../databases/courses.php";

$student_id = $_SESSION['student_id'] ?? 0;

$availableCourses = getAvailableCourses($student_id);
$myCourses = getMyCourses($student_id);

require "../templates/courses.php";
