<div class="max-w-6xl bg-white rounded-xl shadow-sm border border-gray-200 p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-1">Recherche de clients</h3>
    <p class="text-sm text-gray-500 mb-6">Recherchez des clients selon plusieurs critères (nom, email, téléphone, etc.).</p>
    
    <form action="/recherche" method="POST" class="mb-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                <input type="text" name="nom" placeholder="Ex: Dupont"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                    value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
                <input type="text" name="prenom" placeholder="Ex: Jean"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                    value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" placeholder="Ex: jean@example.com"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                <input type="tel" name="telephone" placeholder="Ex: +261 32 12 34 56"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                    value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Numéro client</label>
                <input type="number" name="num_client" placeholder="Ex: 1024"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none"
                    value="<?= htmlspecialchars($_POST['num_client'] ?? '') ?>">
            </div>
        </div>

        <div class="flex justify-end gap-2 pt-2 border-t border-gray-100">
            <button type="reset"
                class="bg-gray-400 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-gray-500 transition-colors">Réinitialiser</button>
            <button type="submit"
                class="bg-slate-900 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-slate-800 transition-colors">Rechercher</button>
        </div>
    </form>

    <?php if (!empty($errors)): ?>
    <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm mb-4">
        <?php foreach ($errors as $error): ?>
        <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (!empty($clients)): ?>
    <div class="overflow-x-auto">
        <table class="min-w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300">
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Numéro</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Prénom</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Téléphone</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Adresse</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date de naissance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-2 text-sm font-semibold text-gray-900"><?= htmlspecialchars($client['num_client']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($client['nom']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($client['prenom']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($client['email']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($client['telephone']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($client['adresse']) ?></td>
                    <td class="px-4 py-2 text-sm text-gray-700"><?= htmlspecialchars($client['date_naissance']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($errors)): ?>
    <p class="text-center text-gray-500 py-8">Aucun client trouvé.</p>
    <?php endif; ?>
    <?php endif; ?>
</div>
