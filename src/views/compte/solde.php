<div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-200 p-6">
  <h3 class="text-lg font-bold text-gray-900 mb-1">Mon solde</h3>
  <form action="/compte/solde" method="POST" class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <select name="num_compte"
          class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white"
          required>
          <?php foreach ($comptes ?? [] as $compte): ?>
            <option value="<?= $compte['num_compte'] ?>">
              <?= htmlspecialchars($compte['num_compte']) ?> - Client: <?= $compte['num_client'] ?>
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

    <div class="flex justify-end pt-4 border-t border-gray-100">
      <button type="submit"
        class="bg-slate-900 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-slate-800 transition-colors">Consulter
        le solde</button>
    </div>
  </form>

  <?php if (isset($compte)): ?>
    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
      <p class="text-sm text-gray-600 mb-3">Détails du compte :</p>
      <div class="grid grid-cols-2 gap-4">
        <div>
          <p class="text-xs text-gray-500">Numéro de compte</p>
          <p class="text-lg font-bold text-slate-900"><?= htmlspecialchars($compte['num_compte']) ?></p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Solde</p>
          <p class="text-lg font-bold text-emerald-600"><?= number_format($compte['solde_actuel'], 2, ',', ' ') ?> Ar</p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Type de compte</p>
          <p class="text-lg font-bold text-slate-900"><?= ucfirst(htmlspecialchars($compte['type_compte'])) ?></p>
        </div>
        <div>
          <p class="text-xs text-gray-500">Statut</p>
          <p class="text-lg font-bold text-slate-900"><?= ucfirst(htmlspecialchars($compte['statut'])) ?></p>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>