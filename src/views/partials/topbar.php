<header class="h-16 bg-white shadow-sm border-b flex items-center justify-between px-8 shrink-0">
    <h2 id="page-title" class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($pageTitle ?? 'Dashboard') ?></h2>
    <div class="flex items-center space-x-4">
        <span id="topbar-session-badge"
            class="text-sm bg-slate-100 text-slate-700 px-3 py-1 rounded-full font-medium">Session : <?= htmlspecialchars($username ?? 'Admin') ?></span>
    </div>
</header>
