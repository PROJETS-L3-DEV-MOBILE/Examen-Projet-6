<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GE-IT BANK - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-slate-900 to-slate-800 min-h-screen flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="p-8 bg-slate-900 text-center text-white">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-500 text-slate-950 mb-4 shadow-lg">
                    <i class="fa-solid fa-landmark text-3xl"></i>
                </div>
                <h2 class="text-2xl font-black tracking-wider">GE-IT BANK</h2>
                <p class="text-sm text-gray-400 mt-1">Créer un compte client</p>
            </div>

            <div class="p-8">
                <?php if (!empty($errors)): ?>
                <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm">
                    <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <form action="/register-client" method="POST" class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nom *</label>
                            <input type="text" name="nom" placeholder="Ex: Dupont"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                value="<?= htmlspecialchars($old['nom'] ?? '') ?>" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Prénom *</label>
                            <input type="text" name="prenom" placeholder="Ex: Jean"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                value="<?= htmlspecialchars($old['prenom'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Email *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-solid fa-envelope"></i>
                            </span>
                            <input type="email" name="email" placeholder="Ex: jean@example.com"
                                class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Téléphone *</label>
                            <input type="tel" name="telephone" placeholder="Ex: +261 32 12 34 56"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                value="<?= htmlspecialchars($old['telephone'] ?? '') ?>" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Date de naissance *</label>
                            <input type="date" name="date_naissance"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                value="<?= htmlspecialchars($old['date_naissance'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Adresse *</label>
                        <input type="text" name="adresse" placeholder="Ex: 123 Rue de la Paix"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                            value="<?= htmlspecialchars($old['adresse'] ?? '') ?>" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe *</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" name="mdp" placeholder="••••••••"
                                class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                                required>
                        </div>
                    </div>

                    <div class="flex justify-between pt-4 border-t border-gray-200">
                        <a href="/login"
                            class="text-sm font-medium text-amber-600 hover:text-amber-700 transition">
                            Retour à la connexion
                        </a>
                        <button type="submit"
                            class="bg-slate-900 text-white px-5 py-2.5 rounded-lg font-bold text-sm hover:bg-slate-800 transition">
                            Créer mon compte
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <p class="text-center text-gray-400 text-xs mt-6">© 2026 GE-IT BANK. Tous droits réservés.</p>
    </div>
</body>

</html>
