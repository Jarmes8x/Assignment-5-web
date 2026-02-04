<?php include 'header.php'; ?>

<div class="max-w-md mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold text-center mb-6 text-blue-600">
        สมัครสมาชิก
    </h2>

    <?php if ($error): ?>
        <p class="text-red-500 mb-4"><?= $error ?></p>
    <?php endif; ?>

    <form method="post" class="space-y-3">
        <input name="first_name" placeholder="ชื่อ" required class="w-full border p-2 rounded">
        <input name="last_name" placeholder="นามสกุล" required class="w-full border p-2 rounded">
        <input type="email" name="email" placeholder="Email" required class="w-full border p-2 rounded">
        <input name="phone_number" placeholder="เบอร์โทร" class="w-full border p-2 rounded">
        <input type="date" name="date_of_birth" class="w-full border p-2 rounded">
        <input type="password" name="password" placeholder="Password" required class="w-full border p-2 rounded">

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            สมัครสมาชิก
        </button>
    </form>
</div>

<?php include 'footer.php'; ?>
