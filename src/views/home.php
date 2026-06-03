<div id="login-screen" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950 px-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
        <div class="p-8 bg-slate-900 text-center text-white">
            <div
                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-500 text-slate-950 mb-4 shadow-lg">
                <i class="fa-solid fa-landmark text-3xl"></i>
            </div>
            <h2 class="text-2xl font-black tracking-wider">GE-IT BANK</h2>
            <p class="text-sm text-gray-400 mt-1">Application de Gestion Bancaire</p>
        </div>

        <form onsubmit="handleLogin(event)" class="p-8 space-y-5">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Identifiant / Email *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-user"></i>
                    </span>
                    <input type="text" id="login-username" placeholder="Ex: admin ou agent"
                        class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                        required>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe *</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fa-solid fa-lock"></i>
                    </span>
                    <input type="password" placeholder="••••••••"
                        class="w-full border border-gray-300 rounded-lg pl-10 pr-3 py-2.5 focus:ring-2 focus:ring-amber-500 focus:outline-none text-sm"
                        required>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-slate-900 text-white py-3 rounded-lg font-bold text-sm tracking-wide hover:bg-slate-800 transition shadow-md">
                Se connecter
            </button>
        </form>
    </div>
</div>


<div id="main-app" class="hidden flex h-screen w-full">

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
                            <button onclick="showSection('ouverture')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium bg-amber-500 text-slate-950 transition-colors text-left">
                                <i class="fa-solid fa-user-plus w-5"></i><span>Ouverture de compte</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('fermeture')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-user-minus w-5"></i><span>Fermeture de compte</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('solde')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-wallet w-5"></i><span>Consultation de solde</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Opérations Courantes
                    </p>
                    <ul class="space-y-1">
                        <li>
                            <button onclick="showSection('depot')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-arrow-down-to-line w-5"></i><span>Dépôt</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('retrait')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-arrow-up-from-line w-5"></i><span>Retrait</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('virement')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-money-bill-transfer w-5"></i><span>Virement bancaire</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Consultation & PDF</p>
                    <ul class="space-y-1">
                        <li>
                            <button onclick="showSection('historique')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-clock-rotate-left w-5"></i><span>Historique / Relevé PDF</span>
                            </button>
                        </li>
                        <li>
                            <button onclick="showSection('recherche')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-magnifying-glass w-5"></i><span>Recherche de clients</span>
                            </button>
                        </li>
                    </ul>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Statistiques</p>
                    <ul class="space-y-1">
                        <li>
                            <button onclick="showSection('stats')"
                                class="nav-link w-full flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-slate-800 hover:text-white transition-colors text-left">
                                <i class="fa-solid fa-chart-line w-5"></i><span>Statistiques des transactions</span>
                            </button>
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
                    <p id="user-profile-name" class="text-xs font-bold text-gray-200 truncate">Utilisateur</p>
                    <p class="text-[10px] text-emerald-500 font-medium"><i
                            class="fa-solid fa-circle text-[8px] animate-pulse mr-1"></i>Session active</p>
                </div>
            </div>
            <button onclick="handleLogout()"
                class="w-full bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white text-xs py-2 px-3 rounded-lg font-medium transition-colors flex items-center justify-center space-x-2">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Déconnexion</span>
            </button>
        </div>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white shadow-sm border-b flex items-center justify-between px-8 shrink-0">
            <h2 id="page-title" class="text-xl font-semibold text-gray-800">Ouverture de compte</h2>
            <div class="flex items-center space-x-4">
                <span id="topbar-session-badge"
                    class="text-sm bg-slate-100 text-slate-700 px-3 py-1 rounded-full font-medium">Session :
                    Admin</span>
            </div>
        </header>

        <div class="flex-1 p-8 overflow-y-auto bg-gray-50">

            <section id="sec-ouverture" class="content-section">
                <div class="max-w-3xl bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Créer un nouveau compte bancaire</h3>
                    <p class="text-sm text-gray-500 mb-6">Lier un compte à un client existant avec un solde initial.</p>
                    <form action="#" method="POST" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Client propriétaire
                                    *</label>
                                <select
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white"
                                    required>
                                    <option value="">-- Sélectionner un client --</option>
                                    <option value="1">Jean Dupont (numClient: 1024)</option>
                                    <option value="2">Miora Razafy (numClient: 1025)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Type de Compte *</label>
                                <select
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500 focus:outline-none bg-white"
                                    required>
                                    <option value="Courant">Courant</option>
                                    <option value="Epargne">Épargne</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Solde Initial *</label>
                                <input type="number" min="0" placeholder="Ex: 100000"
                                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-amber-500"
                                    required>
                            </div>
                        </div>
                        <div class="flex justify-end pt-4 border-t border-gray-100">
                            <button type="submit"
                                class="bg-slate-900 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-slate-800">Valider
                                l'ouverture</button>
                        </div>
                    </form>
                </div>
            </section>

            <section id="sec-fermeture" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Formulaire Fermeture</div>
            </section>
            <section id="sec-solde" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Formulaire Consultation</div>
            </section>
            <section id="sec-depot" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Formulaire Dépôt</div>
            </section>
            <section id="sec-retrait" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Formulaire Retrait</div>
            </section>
            <section id="sec-virement" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Formulaire Virement</div>
            </section>
            <section id="sec-historique" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Tableau Historique</div>
            </section>
            <section id="sec-recherche" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Recherche multicritères</div>
            </section>
            <section id="sec-stats" class="content-section hidden">
                <div class="p-4 bg-white rounded shadow text-sm">Statistiques</div>
            </section>

        </div>
    </main>
</div>

<script>
    // --- 1. FONCTIONS DE LOGIN & LOGOUT ---
    function handleLogin(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        // Récupère la valeur entrée
        const usernameInput = document.getElementById('login-username').value;

        // Met à jour les libellés de session partout sur l'interface
        document.getElementById('user-profile-name').innerText = usernameInput;
        document.getElementById('topbar-session-badge').innerText = "Session : " + usernameInput;

        // Masque l'écran de login et affiche l'application
        document.getElementById('login-screen').classList.add('hidden');
        document.getElementById('main-app').classList.remove('hidden');

        // Remet à zéro sur la première fonctionnalité
        showSection('ouverture');
    }

    function handleLogout() {
        // Masque l'application et réaffiche l'écran de login
        document.getElementById('main-app').classList.add('hidden');
        document.getElementById('login-screen').classList.remove('hidden');

        // Optionnel : Vider le champ de saisie
        document.getElementById('login-username').value = '';
    }

    // --- 2. GESTION NAVIGATION ---
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(sec => sec.classList.add('hidden'));

        const targetSection = document.getElementById('sec-' + sectionId);
        if (targetSection) targetSection.classList.remove('hidden');

        const titles = {
            'ouverture': 'Gestion des Comptes > Ouverture de compte',
            'fermeture': 'Gestion des Comptes > Fermeture de compte',
            'solde': 'Gestion des Comptes > Consultation de solde',
            'depot': 'Opérations Courantes > Dépôt',
            'retrait': 'Opérations Courantes > Retrait',
            'virement': 'Opérations Courantes > Virement bancaire',
            'historique': 'Consultation > Historique & Relevé PDF',
            'recherche': 'Consultation > Recherche de clients',
            'stats': 'Statistiques > Statistiques des transactions'
        };
        document.getElementById('page-title').innerText = titles[sectionId] || 'Gestion Bancaire';

        const links = document.querySelectorAll('.nav-link');
        links.forEach(link => {
            link.classList.remove('bg-amber-500', 'text-slate-950');
            link.classList.add('text-gray-300', 'hover:bg-slate-800', 'hover:text-white');
        });

        if (event && event.currentTarget) {
            const clickedButton = event.currentTarget;
            clickedButton.classList.remove('text-gray-300', 'hover:bg-slate-800', 'hover:text-white');
            clickedButton.classList.add('bg-amber-500', 'text-slate-950');
        }
    }
</script>