<?php
function getCourses(): mysqli_result|bool
{
    $conn = getConnection();
    $sql = 'select * from courses';
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

function getAvailableCourses(int $student_id)
{
    $conn = getConnection();
    $sql = "
        SELECT * FROM courses 
        WHERE course_id NOT IN (
            SELECT course_id FROM enrollment WHERE student_id = ?
        )
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    return $stmt->get_result();
}

function getMyCourses(int $student_id)
{
    $conn = getConnection();
    $sql = "
        SELECT e.enrollment_id, c.course_code, c.course_name 
        FROM enrollment e
        JOIN courses c ON e.course_id = c.course_id
        WHERE e.student_id = ?
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    return $stmt->get_result();
}
