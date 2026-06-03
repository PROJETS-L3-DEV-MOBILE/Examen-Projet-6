<?php

namespace App\Controllers;

use App\Repositories\CompteRepository;
use App\Repositories\TransactionRepository;

class HistoriqueController
{
    public function __construct(
        private CompteRepository $compteRepository,
        private TransactionRepository $transactionRepository
    ) {
    }

    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('historique', [
                'comptes' => $this->compteRepository->getAll() ?? [],
                'pageTitle' => 'Consultation > Historique & Relevé PDF',
                'activeSection' => 'historique'
            ]);
            return;
        }

        $errors = [];
        $transactions = [];

        $numCompte = (int) ($_POST['num_compte'] ?? 0);

        if ($numCompte === 0) {
            $errors[] = 'Veuillez sélectionner un compte.';
        } else {
            $compte = $this->compteRepository->getByNumCompte($numCompte);
            if (!$compte) {
                $errors[] = 'Compte introuvable.';
            } else {
                $transactions = $this->transactionRepository->getByNumCompte($numCompte) ?? [];
            }
        }

        $this->render('historique', [
            'comptes' => $this->compteRepository->getAll() ?? [],
            'transactions' => $transactions,
            'errors' => $errors,
            'pageTitle' => 'Consultation > Historique & Relevé PDF',
            'activeSection' => 'historique'
        ]);
    }

    public function pdf(): void
    {
        $numCompte = (int) ($_GET['num_compte'] ?? 0);

        if ($numCompte === 0) {
            header('Location: /historique');
            exit;
        }

        $compte = $this->compteRepository->getByNumCompte($numCompte);
        if (!$compte) {
            header('Location: /historique');
            exit;
        }

        $transactions = $this->transactionRepository->getByNumCompte($numCompte) ?? [];

        // Générer le PDF (à implémenter avec une bibliothèque comme TCPDF ou mPDF)
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="releve_' . $numCompte . '.pdf"');

        // Pour l'instant, on peut laisser un placeholder
        echo "PDF Relevé du compte: " . $numCompte;
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
