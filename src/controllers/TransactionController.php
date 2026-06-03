<?php

namespace App\Controllers;

use App\Services\TransactionService;
use App\Repositories\CompteRepository;

class TransactionController
{
    public function __construct(
        private TransactionService $transactionService,
        private CompteRepository $compteRepository
    ) {
    }

    public function depot(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('transaction/depot', [
                'comptes' => $this->compteRepository->getAll() ?? [],
                'pageTitle' => 'Opérations Courantes > Dépôt',
                'activeSection' => 'depot'
            ]);
            return;
        }

        $errors = [];
        $old = $_POST;

        $numCompteDestination = (int) ($_POST['num_compte_destination'] ?? 0);
        $montant = (float) ($_POST['montant'] ?? 0);

        if ($numCompteDestination === 0 || $montant <= 0) {
            $errors[] = 'Tous les champs sont obligatoires et le montant doit être positif.';
        }

        if (empty($errors)) {
            try {
                $this->transactionService->depot($numCompteDestination, $montant);
                $this->render('transaction/depot', [
                    'comptes' => $this->compteRepository->getAll() ?? [],
                    'success' => 'Dépôt effectué avec succès.',
                    'pageTitle' => 'Opérations Courantes > Dépôt',
                    'activeSection' => 'depot'
                ]);
                return;
            } catch (\Exception $e) {
                $errors[] = 'Erreur : ' . $e->getMessage();
            }
        }

        $this->render('transaction/depot', [
            'comptes' => $this->compteRepository->getAll() ?? [],
            'errors' => $errors,
            'old' => $old,
            'pageTitle' => 'Opérations Courantes > Dépôt',
            'activeSection' => 'depot'
        ]);
    }

    public function retrait(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('transaction/retrait', [
                'comptes' => $this->compteRepository->getAll() ?? [],
                'pageTitle' => 'Opérations Courantes > Retrait',
                'activeSection' => 'retrait'
            ]);
            return;
        }

        $errors = [];
        $old = $_POST;

        $numCompteSource = (int) ($_POST['num_compte_source'] ?? 0);
        $montant = (float) ($_POST['montant'] ?? 0);

        if ($numCompteSource === 0 || $montant <= 0) {
            $errors[] = 'Tous les champs sont obligatoires et le montant doit être positif.';
        }

        if (empty($errors)) {
            try {
                $this->transactionService->retrait($numCompteSource, $montant);
                $this->render('transaction/retrait', [
                    'comptes' => $this->compteRepository->getAll() ?? [],
                    'success' => 'Retrait effectué avec succès.',
                    'pageTitle' => 'Opérations Courantes > Retrait',
                    'activeSection' => 'retrait'
                ]);
                return;
            } catch (\Exception $e) {
                $errors[] = 'Erreur : ' . $e->getMessage();
            }
        }

        $this->render('transaction/retrait', [
            'comptes' => $this->compteRepository->getAll() ?? [],
            'errors' => $errors,
            'old' => $old,
            'pageTitle' => 'Opérations Courantes > Retrait',
            'activeSection' => 'retrait'
        ]);
    }

    public function virement(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->render('transaction/virement', [
                'comptes' => $this->compteRepository->getAll() ?? [],
                'pageTitle' => 'Opérations Courantes > Virement bancaire',
                'activeSection' => 'virement'
            ]);
            return;
        }

        $errors = [];
        $old = $_POST;

        $numCompteSource = (int) ($_POST['num_compte_source'] ?? 0);
        $numCompteDestination = (int) ($_POST['num_compte_destination'] ?? 0);
        $montant = (float) ($_POST['montant'] ?? 0);

        if ($numCompteSource === 0 || $numCompteDestination === 0 || $montant <= 0) {
            $errors[] = 'Tous les champs sont obligatoires et le montant doit être positif.';
        } elseif ($numCompteSource === $numCompteDestination) {
            $errors[] = 'Le compte source et destination doivent être différents.';
        }

        if (empty($errors)) {
            try {
                $this->transactionService->virement($numCompteSource, $numCompteDestination, $montant);
                $this->render('transaction/virement', [
                    'comptes' => $this->compteRepository->getAll() ?? [],
                    'success' => 'Virement effectué avec succès.',
                    'pageTitle' => 'Opérations Courantes > Virement bancaire',
                    'activeSection' => 'virement'
                ]);
                return;
            } catch (\Exception $e) {
                $errors[] = 'Erreur : ' . $e->getMessage();
            }
        }

        $this->render('transaction/virement', [
            'comptes' => $this->compteRepository->getAll() ?? [],
            'errors' => $errors,
            'old' => $old,
            'pageTitle' => 'Opérations Courantes > Virement bancaire',
            'activeSection' => 'virement'
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
