<?php

namespace App\Controllers;

use App\Repositories\ClientRepository;

class RechercheController
{
    public function __construct(
        private ClientRepository $clientRepository
    ) {
    }

    public function index(): void
    {
        $clients = [];
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telephone = trim($_POST['telephone'] ?? '');
            $numClient = trim($_POST['num_client'] ?? '');

            try {
                $clients = $this->clientRepository->search([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'email' => $email,
                    'telephone' => $telephone,
                    'num_client' => $numClient
                ]) ?? [];
            } catch (\Exception $e) {
                $errors[] = 'Erreur de recherche : ' . $e->getMessage();
            }
        }

        $this->render('recherche', [
            'clients' => $clients,
            'errors' => $errors,
            'pageTitle' => 'Consultation > Recherche de clients',
            'activeSection' => 'recherche'
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
