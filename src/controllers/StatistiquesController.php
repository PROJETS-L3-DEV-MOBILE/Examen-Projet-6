<?php

namespace App\Controllers;

use App\Repositories\TransactionRepository;

class StatistiquesController
{
    public function __construct(
        private TransactionRepository $transactionRepository
    ) {
    }

    public function index(): void
    {
        $stats = [];

        try {
            $totalTransactions = $this->transactionRepository->count() ?? 0;
            $montantTotal = $this->transactionRepository->getTotalMontant() ?? 0;
            $transactionsValidees = $this->transactionRepository->countByStatut('validé') ?? 0;
            $transactionsAnnulees = $this->transactionRepository->countByStatut('annulé') ?? 0;
            $transactionsParType = $this->transactionRepository->countByType() ?? [];
            $transactionsParJour = $this->transactionRepository->countByDay() ?? [];

            $stats = [
                'total_transactions' => $totalTransactions,
                'montant_total' => $montantTotal,
                'transactions_validees' => $transactionsValidees,
                'transactions_annulees' => $transactionsAnnulees,
                'transactions_par_type' => $transactionsParType,
                'transactions_par_jour' => $transactionsParJour
            ];
        } catch (\Exception $e) {
            // Gestion silencieuse de l'erreur
        }

        $this->render('statistiques', [
            'stats' => $stats,
            'pageTitle' => 'Statistiques > Statistiques des transactions',
            'activeSection' => 'stats'
        ]);
    }

    private function render(string $view, array $data = []): void
    {
        ob_start();
        extract($data);
        include __DIR__ . '/../views/' . $view . '.php';
        $content = ob_get_clean();
        
        $username = $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?? 'Utilisateur';
        $pageTitle = $data['pageTitle'] ?? 'Dashboard';
        $activeSection = $data['activeSection'] ?? '';
        
        include __DIR__ . '/../views/dashboard-layout.php';
    }
}
