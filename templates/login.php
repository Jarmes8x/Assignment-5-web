<?php include 'header.php'; ?>

<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">
        เข้าสู่ระบบ
    </h2>

    <?php if ($error): ?>
        <p class="text-red-500 mb-4 text-center"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" class="space-y-4">
        <input type="email" name="email" placeholder="Email"
            class="w-full border px-4 py-2 rounded" required>

        <input type="password" name="password" placeholder="Password"
            class="w-full border px-4 py-2 rounded" required>

        <button
            class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            เข้าสู่ระบบ
        </button>
    </form>

    <p class="text-sm text-center mt-4">
        ยังไม่มีบัญชี?
        <a href="/register" class="text-blue-600 underline">
            สมัครสมาชิก
        </a>
    </p>
</div>

<?php include 'footer.php'; ?>
