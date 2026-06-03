<div class="max-w-6xl bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-1">Statistiques des transactions</h3>
    <p class="text-sm text-gray-500 mb-6">Consultez les statistiques générales des transactions.</p>
    
    <?php if (!empty($stats)): ?>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wider mb-1">Total des transactions</p>
            <p class="text-2xl font-bold text-blue-900"><?= $stats['total_transactions'] ?? 0 ?></p>
        </div>
        <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-4">
            <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider mb-1">Montant total</p>
            <p class="text-2xl font-bold text-emerald-900"><?= number_format($stats['montant_total'] ?? 0, 2, ',', ' ') ?> Ar</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-xs font-semibold text-green-600 uppercase tracking-wider mb-1">Transactions validées</p>
            <p class="text-2xl font-bold text-green-900"><?= $stats['transactions_validees'] ?? 0 ?></p>
        </div>
        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
            <p class="text-xs font-semibold text-orange-600 uppercase tracking-wider mb-1">Transactions annulées</p>
            <p class="text-2xl font-bold text-orange-900"><?= $stats['transactions_annulees'] ?? 0 ?></p>
        </div>
    </div>

    <?php if (!empty($stats['transactions_par_type'])): ?>
    <div class="mb-6">
        <h4 class="text-md font-semibold text-gray-900 mb-3">Transactions par type</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-300">
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Type</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Nombre</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stats['transactions_par_type'] as $type): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars(ucfirst($type['type_transaction'])) ?></td>
                        <td class="px-4 py-2 text-sm text-right text-gray-700"><?= $type['nombre'] ?></td>
                        <td class="px-4 py-2 text-sm text-right font-semibold text-emerald-600"><?= number_format($type['montant_total'], 2, ',', ' ') ?> Ar</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($stats['transactions_par_jour'])): ?>
    <div>
        <h4 class="text-md font-semibold text-gray-900 mb-3">Transactions par jour (7 derniers jours)</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-300">
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Nombre</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Montant total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($stats['transactions_par_jour'] as $jour): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($jour['date']) ?></td>
                        <td class="px-4 py-2 text-sm text-right text-gray-700"><?= $jour['nombre'] ?></td>
                        <td class="px-4 py-2 text-sm text-right font-semibold text-emerald-600"><?= number_format($jour['montant_total'], 2, ',', ' ') ?> Ar</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
    <?php else: ?>
    <p class="text-center text-gray-500 py-8">Aucune statistique disponible.</p>
    <?php endif; ?>
</div>
