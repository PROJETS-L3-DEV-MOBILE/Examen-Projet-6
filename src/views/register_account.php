<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GE-IT BANK - Création de compte</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-slate-900 to-slate-800 min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="p-8 bg-slate-900 text-center text-white">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-500 text-slate-950 mb-4 shadow-lg">
                    <i class="fa-solid fa-landmark text-3xl"></i>
                </div>
                <h2 class="text-2xl font-black tracking-wider">GE-IT BANK</h2>
                <p class="text-sm text-gray-400 mt-1">Créer un compte bancaire</p>
            </div>

            <div class="p-8">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Vous avez déjà un compte client ?</h3>
                <p class="text-sm text-gray-600 mb-4">Entrez vos identifiants pour créer un compte bancaire.</p>

                <?php if (!empty($errors)): ?>
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                    <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <form action="/register-account" method="POST" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Numéro client *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-solid fa-id-card"></i>
                            </span>
                            <input type="number" name="num_client" placeholder="Ex: 1024"
                                class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                value="<?= htmlspecialchars($old['num_client'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="mdp" placeholder="••••••••"
                                class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                value="<?= htmlspecialchars($old['mdp'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Type de compte *</label>
                        <select name="account_type"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm bg-white"
                            required>
                            <option value="">-- Sélectionner un type --</option>
                            <option value="courant" <?= (isset($old['account_type']) && $old['account_type'] === 'courant') ? 'selected' : '' ?>>Compte Courant</option>
                            <option value="epargne" <?= (isset($old['account_type']) && $old['account_type'] === 'epargne') ? 'selected' : '' ?>>Compte Épargne</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 text-white py-3 rounded-lg font-bold text-sm tracking-wide hover:bg-slate-800 transition shadow-md">
                        Créer le compte
                    </button>
                </form>

                <div class="mt-6 border-t border-gray-200 pt-6">
                    <p class="text-sm text-gray-600 text-center">Vous êtes nouveau client ?</p>
                    <a href="/register-client"
                        class="w-full mt-3 bg-amber-500 text-slate-950 py-3 rounded-lg font-bold text-sm tracking-wide hover:bg-amber-600 transition flex items-center justify-center">
                        <i class="fa-solid fa-user-plus mr-2"></i> Créer un compte client
                    </a>
                </div>

                <a href="/login"
                    class="w-full mt-3 text-sm font-medium text-center text-amber-600 hover:text-amber-700 transition block">
                    Retour à la connexion
                </a>
            </div>
        </div>

        <p class="text-center text-gray-400 text-xs mt-6">© 2026 GE-IT BANK. Tous droits réservés.</p>
    </div>
</body>

</html>
