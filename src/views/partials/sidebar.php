<aside class="w-64 bg-slate-900 text-white flex flex-col justify-between shadow-xl shrink-0">
    <div>
        <div class="p-5 bg-slate-950 flex items-center space-x-3 border-b border-slate-800">
            <i class="fa-solid fa-landmark text-amber-500 text-2xl"></i>
            <span class="text-xl font-bold tracking-wider">GE-IT BANK</span>
        </div>

        <nav class="p-4 space-y-6 overflow-y-auto" style="max-height: calc(100vh - 180px);">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Gestion des Comptes</p>
                <ul class="space-y-1">
                    <li>
                        <a href="/compte/ouverture"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'ouverture') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-user-plus w-5"></i><span>Ouverture de compte</span>
                        </a>
                    </li>
                    <li>
                        <a href="/compte/fermeture"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'fermeture') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-user-minus w-5"></i><span>Fermeture de compte</span>
                        </a>
                    </li>
                    <li>
                        <a href="/compte/solde"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'solde') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-wallet w-5"></i><span>Consultation de solde</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Opérations Courantes</p>
                <ul class="space-y-1">
                    <li>
                        <a href="/transaction/depot"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'depot') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-arrow-down-to-line w-5"></i><span>Dépôt</span>
                        </a>
                    </li>
                    <li>
                        <a href="/transaction/retrait"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'retrait') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-arrow-up-from-line w-5"></i><span>Retrait</span>
                        </a>
                    </li>
                    <li>
                        <a href="/transaction/virement"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'virement') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-money-bill-transfer w-5"></i><span>Virement bancaire</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Consultation & PDF</p>
                <ul class="space-y-1">
                    <li>
                        <a href="/historique"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'historique') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-clock-rotate-left w-5"></i><span>Historique / Relevé PDF</span>
                        </a>
                    </li>
                    <li>
                        <a href="/recherche"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'recherche') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-magnifying-glass w-5"></i><span>Recherche de clients</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Statistiques</p>
                <ul class="space-y-1">
                    <li>
                        <a href="/statistiques"
                            class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left block <?= ($activeSection === 'stats') ? 'bg-amber-500 text-slate-950 hover:bg-amber-500' : '' ?>">
                            <i class="fa-solid fa-chart-line w-5"></i><span>Statistiques des transactions</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <div class="p-4 bg-slate-950 border-t border-slate-800 space-y-3">
        <div class="flex items-center space-x-3">
            <div
                class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-amber-500 font-bold border border-slate-700">
                <i class="fa-solid fa-user-tie text-sm"></i>
            </div>
            <div class="flex-1 overflow-hidden">
                <p id="user-profile-name" class="text-xs font-bold text-gray-200 truncate"><?= htmlspecialchars($username ?? 'Utilisateur') ?></p>
                <p class="text-[10px] text-emerald-500 font-medium"><i
                        class="fa-solid fa-circle text-[8px] animate-pulse mr-1"></i>Session active</p>
            </div>
        </div>
        <a href="/logout"
            class="w-full bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white text-xs py-2 px-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Déconnexion</span>
        </a>
    </div>
</aside>
