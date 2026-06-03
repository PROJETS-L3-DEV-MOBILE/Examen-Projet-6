<div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-200 p-6">
  <h3 class="text-lg font-bold text-gray-900 mb-1">Fermer un compte bancaire</h3>
  <p class="text-sm text-gray-500 mb-6">Fermer un compte existant. Attention : le compte ne peut être fermé que s'il a
    un solde nul.</p>
  <form action="/compte/fermeture" method="POST" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de compte *</label>
        <select name="num_compte"
          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white"
          required>
          <option value="">-- Sélectionner un compte --</option>
          <?php foreach ($comptes ?? [] as $compte): ?>
            <option value="<?= $compte['num_compte'] ?>">
              <?= htmlspecialchars($compte['num_compte']) ?> - Solde: <?= number_format($compte['solde_actuel'], 2, ',', ' ') ?>
              Ar
            </option>
          <?php endforeach; ?>
        </select>
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
        class="bg-red-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors">Fermer
        le compte</button>
    </div>
  </form>
</div>