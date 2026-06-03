<?php include __DIR__ . '/partials/header.php'; ?>

<div class="flex h-screen w-full">
    <?php include __DIR__ . '/partials/sidebar.php'; ?>

    <main class="flex-1 flex flex-col overflow-hidden">
        <?php include __DIR__ . '/partials/topbar.php'; ?>

        <div class="flex-1 p-8 overflow-y-auto bg-gray-50">
            <?= $content ?? '' ?>
        </div>
    </main>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>
