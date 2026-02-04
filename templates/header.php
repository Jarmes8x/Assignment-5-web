<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">


<head>
    <meta charset="UTF-8">
    <title>Enrollment System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800">

    <header class="bg-blue-600 text-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/"><h1 class="text-2xl font-bold tracking-wide">
                Enrollment System
            </h1></a>

            <nav class="space-x-6 text-sm font-medium flex items-center">

                <a href="/" class="hover:text-yellow-300 transition">หน้าแรก</a>
                <a href="/courses" class="hover:text-yellow-300 transition">หลักสูตร</a>
                <a href="/contact" class="hover:text-yellow-300 transition">ติดต่อเรา</a>

                <?php if (isset($_SESSION['student_name'])): ?>

                    <span class="ml-6 text-yellow-300 font-semibold">
                        👤 <?= $_SESSION['student_name'] ?>
                    </span>

                    <a href="/logout"
                        class="ml-4 bg-red-500 px-3 py-1 rounded hover:bg-red-600 transition">
                        Logout
                    </a>

                <?php else: ?>

                    <a href="/register" class="hover:text-yellow-300 transition">
                        สมัครสมาชิก
                    </a>

                    <a href="/login"
                        class="bg-green-500 px-3 py-1 rounded hover:bg-green-600 transition">
                        เข้าสู่ระบบ
                    </a>

                <?php endif; ?>

            </nav>

        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 py-8">