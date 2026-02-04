<?php
session_start();
require_once __DIR__ . '/../includes/database.php';

$isLogin = isset($_SESSION['student_id']);
$studentId = $isLogin ? $_SESSION['student_id'] : null;

// ดึงรายวิชาทั้งหมด
$conn = getConnection();
$courses = $conn->query("SELECT * FROM courses");

// ถ้า login → ดึงวิชาที่ลงทะเบียนแล้ว
$enrolled = [];
if ($isLogin) {
    $stmt = $conn->prepare("
        SELECT course_id 
        FROM enrollment 
        WHERE student_id = ?
    ");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) {
        $enrolled[] = $row['course_id'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Courses | Enrollment System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

<?php include 'header.php'; ?>

<main class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold text-amber-600 mb-8">
        รายวิชาที่เปิดลงทะเบียน
    </h1>

    <div class="space-y-4">

        <?php while ($c = $courses->fetch_assoc()): ?>

            <div class="flex justify-between items-center bg-white p-5 rounded-lg shadow">

                <div>
                    <p class="font-semibold text-lg">
                        <?= htmlspecialchars($c['course_code']) ?>
                        - <?= htmlspecialchars($c['course_name']) ?>
                    </p>
                </div>

                <!-- ===== ปุ่มด้านขวา ===== -->
                <div>

                    <?php if (!$isLogin): ?>

                        <!-- ยังไม่ login -->
                        <a href="/login"
                           class="bg-gray-300 text-gray-600 px-4 py-2 rounded
                                  cursor-not-allowed">
                            กรุณาเข้าสู่ระบบ
                        </a>

                    <?php elseif (in_array($c['course_id'], $enrolled)): ?>

                        <!-- ลงทะเบียนแล้ว -->
                        <span
                            class="bg-amber-200 text-amber-800 px-4 py-2 rounded font-semibold">
                            ลงทะเบียนแล้ว
                        </span>

                    <?php else: ?>

                        <!-- login แล้ว และยังไม่ลง -->
                        <form method="post" action="/enroll"
                              onsubmit="return confirm('ยืนยันลงทะเบียนวิชานี้?')">
                            <input type="hidden" name="course_id"
                                   value="<?= $c['course_id'] ?>">
                            <button
                                class="bg-amber-500 text-gray-900 px-4 py-2 rounded
                                       hover:bg-amber-600 font-semibold transition">
                                ลงทะเบียน
                            </button>
                        </form>

                    <?php endif; ?>

                </div>
            </div>

        <?php endwhile; ?>

    </div>

</main>

<?php include 'footer.php'; ?>

</body>
</html>
