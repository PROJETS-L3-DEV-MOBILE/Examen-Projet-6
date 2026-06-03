<div class="max-w-6xl bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-1">Historique des transactions</h3>
    <p class="text-sm text-gray-500 mb-6">Consultez l'historique des transactions d'un compte et téléchargez le relevé en PDF.</p>
    
    <form action="/historique" method="POST" class="mb-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de compte *</label>
                <select name="num_compte"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white"
                    required>
                    <option value="">-- Sélectionner un compte --</option>
                    <?php foreach ($comptes ?? [] as $compte): ?>
                    <option value="<?= $compte['num_compte'] ?>" <?= (isset($_POST['num_compte']) && $_POST['num_compte'] == $compte['num_compte']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($compte['num_compte']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
            <button type="submit"
                class="bg-slate-900 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-slate-800 transition-colors">Charger
                l'historique</button>
        </div>
    </form>

    <?php if (!empty($errors)): ?>
    <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm mb-4">
        <?php foreach ($errors as $error): ?>
        <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($transactions)): ?>
    <div class="mb-4">
        <a href="/historique/pdf?num_compte=<?= htmlspecialchars($_POST['num_compte'] ?? '') ?>"
            class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">
            <i class="fa-solid fa-file-pdf"></i> Télécharger le relevé PDF
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Type</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Compte source</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Compte destination</th>
                    <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Montant</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($transaction['date_transaction']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars(ucfirst($transaction['type_transaction'])) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($transaction['num_compte_source'] ?? 'N/A') ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($transaction['num_compte_destination']) ?></td>
                    <td class="px-4 py-2 text-sm font-semibold text-right text-emerald-600"><?= number_format($transaction['montant'], 2, ',', ' ') ?> Ar</td>
                    <td class="px-4 py-2 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-medium <?= ($transaction['statut_transaction'] === 'validé') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                            <?= htmlspecialchars(ucfirst($transaction['statut_transaction'])) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)): ?>
    <p class="text-center text-gray-500 py-8">Aucune transaction trouvée.</p>
    <?php endif; ?>
    <?php endif; ?>
</div>
