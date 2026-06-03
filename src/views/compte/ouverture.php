<div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-200 p-6">
  <h3 class="text-lg font-bold text-gray-900 mb-1">Créer un nouveau compte bancaire</h3>
  <p class="text-sm text-gray-500 mb-6">Lier un compte à un client existant avec un solde initial.</p>
  <form action="/compte/ouverture" method="POST" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Client propriétaire *</label>
        <select name="num_client"
          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white"
          required>
          <option value="">-- Sélectionner un client --</option>
          <?php foreach ($clients ?? [] as $client): ?>
            <option value="<?= $client['num_client'] ?>">
              <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?> (<?= $client['num_client'] ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Type de Compte *</label>
        <select name="type_compte"
          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white"
          required>
          <option value="">-- Sélectionner un type --</option>
          <option value="courant">Courant</option>
          <option value="epargne">Épargne</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Solde Initial *</label>
        <input type="number" name="solde_initial" min="0" placeholder="Ex: 100000"
          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none"
          value="<?= htmlspecialchars($old['solde_initial'] ?? '') ?>" required>
      </div>
    </div>

    <?php if (!empty($errors)): ?>
      <div class="p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
        <?php foreach ($errors as $error): ?>
          <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
      <div class="p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
        <p><?= htmlspecialchars($success) ?></p>
      </div>
    <?php endif; ?>

    <div class="flex justify-end pt-4 border-t border-gray-100">
      <button type="submit"
        class="bg-slate-900 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-slate-800 transition-colors">Valider
        l'ouverture</button>
    </div>
  </form>
</div>