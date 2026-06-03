<?php

namespace App\Controllers;

use App\Services\AuthService;

class HomeController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function index(): void
    {
        ob_start();
        echo '<div class="max-w-6xl mx-auto">';
        echo '<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">';
        echo '<h1 class="text-3xl font-bold text-gray-900 mb-2">Bienvenue dans GE-IT BANK</h1>';
        echo '<p class="text-gray-600 mb-6">Utilisez le menu de gauche pour accéder aux différentes fonctionnalités.</p>';
        echo '<div class="grid grid-cols-1 md:grid-cols-3 gap-4">';
        echo '<div class="p-4 bg-blue-50 rounded-lg border border-blue-200">';
        echo '<i class="fa-solid fa-user-plus text-blue-600 text-3xl mb-2"></i>';
        echo '<p class="font-semibold text-gray-900">Gestion des Comptes</p>';
        echo '<p class="text-sm text-gray-600">Ouvrir, fermer ou consulter les comptes</p>';
        echo '</div>';
        echo '<div class="p-4 bg-emerald-50 rounded-lg border border-emerald-200">';
        echo '<i class="fa-solid fa-money-bill-transfer text-emerald-600 text-3xl mb-2"></i>';
        echo '<p class="font-semibold text-gray-900">Opérations Courantes</p>';
        echo '<p class="text-sm text-gray-600">Effectuer dépôts, retraits, virements</p>';
        echo '</div>';
        echo '<div class="p-4 bg-orange-50 rounded-lg border border-orange-200">';
        echo '<i class="fa-solid fa-chart-line text-orange-600 text-3xl mb-2"></i>';
        echo '<p class="font-semibold text-gray-900">Statistiques</p>';
        echo '<p class="text-sm text-gray-600">Consulter les statistiques et l\'historique</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        $content = ob_get_clean();

        $username = $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?? 'Utilisateur';
        $pageTitle = 'Accueil';
        $activeSection = '';

        include __DIR__ . '/../views/dashboard-layout.php';
    }

    private function render(string $view, ?string $username, int $activeIndex): void
    {
        ob_start();
        include __DIR__ . '/../views/' . $view . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../views/layout.php';
    }
}
