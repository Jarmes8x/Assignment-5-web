<?php
session_start();
include 'header.php';

$studentId = $_SESSION['student_id'] ?? null;
$myCourses = null;

if ($studentId) {
    $conn = getConnection();

    $sql = "
        SELECT e.enrollment_id, c.course_code, c.course_name
        FROM enrollment e
        JOIN courses c ON e.course_id = c.course_id
        WHERE e.student_id = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $myCourses = $stmt->get_result();
}
?>

<main class="max-w-7xl mx-auto px-6 py-8">

<?php if ($studentId && $myCourses && $myCourses->num_rows > 0): ?>

    <h2 class="text-2xl font-bold mb-6 text-blue-600">
        วิชาที่คุณลงทะเบียนแล้ว
    </h2>

    <?php while ($m = $myCourses->fetch_assoc()): ?>
        <div class="flex justify-between items-center bg-white p-4 mb-3 rounded shadow">
            <div class="font-medium">
                <?= $m['course_code'] ?> - <?= $m['course_name'] ?>
            </div>

            <form method="post" action="/withdraw"
                  onsubmit="return confirm('ยืนยันถอนวิชานี้?')">
                <input type="hidden" name="enrollment_id" value="<?= $m['enrollment_id'] ?>">
                <button class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                    ถอน
                </button>
            </form>
        </div>
    <?php endwhile; ?>

<?php else: ?>

    <div class="bg-white p-10 rounded shadow text-center">
        <h2 class="text-3xl font-bold text-blue-600 mb-4">
            ยินดีต้อนรับสู่ระบบลงทะเบียนเรียน
        </h2>

        <p class="text-gray-600 mb-6">
            คุณยังไม่ได้ลงทะเบียนเรียน กรุณาเลือกวิชาที่ต้องการ
        </p>

        <a href="/courses"
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            ดูรายวิชา
        </a>
    </div>

<?php endif; ?>

</main>

<?php include 'footer.php'; ?>
