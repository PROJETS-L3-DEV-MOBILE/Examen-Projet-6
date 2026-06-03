<?php

namespace App\Controllers;

use App\Models\AccountType;
use App\Services\CompteService;
use App\Repositories\CompteRepository;
use App\Repositories\ClientRepository;

class CompteController
{
  public function __construct(
    private CompteService $compteService,
    private CompteRepository $compteRepository,
    private ClientRepository $clientRepository
  ) {
  }

  public function ouverture(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $this->render('compte/ouverture', [
        'clients' => $this->clientRepository->getAll() ?? [],
        'pageTitle' => 'Gestion des Comptes > Ouverture de compte',
        'activeSection' => 'ouverture'
      ]);
      return;
    }

    $errors = [];
    $old = $_POST;

    $numClient = (int) ($_POST['num_client'] ?? 0);
    $typeCompte = $_POST['type_compte'] ?? '';
    $soldeInitial = (float) ($_POST['solde_initial'] ?? 0);

    if ($numClient === 0 || $typeCompte === '' || $soldeInitial < 0) {
      $errors[] = 'Tous les champs sont obligatoires.';
    }

    $type = $typeCompte === "Courant" ? AccountType::CHECKING : AccountType::SAVINGS;

    if (empty($errors)) {
      try {
        $this->compteService->createCompte($numClient, $type, $soldeInitial);
        $this->render('compte/ouverture', [
          'clients' => $this->clientRepository->getAll() ?? [],
          'success' => 'Compte créé avec succès.',
          'pageTitle' => 'Gestion des Comptes > Ouverture de compte',
          'activeSection' => 'ouverture'
        ]);
        return;
      } catch (\Exception $e) {
        $errors[] = 'Erreur : ' . $e->getMessage();
      }
    }

    $this->render('compte/ouverture', [
      'clients' => $this->clientRepository->getAll() ?? [],
      'errors' => $errors,
      'old' => $old,
      'pageTitle' => 'Gestion des Comptes > Ouverture de compte',
      'activeSection' => 'ouverture'
    ]);
  }

  public function fermeture(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $this->render('compte/fermeture', [
        'comptes' => $this->compteRepository->getAll() ?? [],
        'pageTitle' => 'Gestion des Comptes > Fermeture de compte',
        'activeSection' => 'fermeture'
      ]);
      return;
    }

    $errors = [];
    $numCompte = (int) ($_POST['num_compte'] ?? 0);

    if ($numCompte === 0) {
      $errors[] = 'Veuillez sélectionner un compte.';
    }

    if (empty($errors)) {
      try {
        $compte = $this->compteRepository->getByNumCompte($numCompte);
        if (!$compte) {
          $errors[] = 'Compte introuvable.';
        } elseif ($compte->getSoldeActuel() !== 0.0) {
          $errors[] = 'Le compte ne peut être fermé que si le solde est nul.';
        } else {
          $this->compteRepository->delete($numCompte);
          $this->render('compte/fermeture', [
            'comptes' => $this->compteRepository->getAll() ?? [],
            'success' => 'Compte fermé avec succès.',
            'pageTitle' => 'Gestion des Comptes > Fermeture de compte',
            'activeSection' => 'fermeture'
          ]);
          return;
        }
      } catch (\Exception $e) {
        $errors[] = 'Erreur : ' . $e->getMessage();
      }
    }

    $this->render('compte/fermeture', [
      'comptes' => $this->compteRepository->getAll() ?? [],
      'errors' => $errors,
      'pageTitle' => 'Gestion des Comptes > Fermeture de compte',
      'activeSection' => 'fermeture'
    ]);
  }

  public function solde(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      $this->render('compte/solde', [
        'comptes' => $this->compteRepository->getAll() ?? [],
        'pageTitle' => 'Gestion des Comptes > Consultation de solde',
        'activeSection' => 'solde'
      ]);
      return;
    }

    $errors = [];
    $compte = null;
    $numCompte = (int) ($_POST['num_compte'] ?? 0);

    if ($numCompte === 0) {
      $errors[] = 'Veuillez sélectionner un compte.';
    } else {
      $compte = $this->compteRepository->getByNumCompte($numCompte);
      if (!$compte) {
        $errors[] = 'Compte introuvable.';
      }
    }

    $this->render('compte/solde', [
      'comptes' => $this->compteRepository->getAll() ?? [],
      'compte' => $compte ? [
        'num_compte' => $compte->getNumCompte(),
        'solde' => $compte->getSoldeActuel(),
        'type_compte' => $compte->getTypeCompte()->value,
        'statut' => $compte->getStatutCompte()->value
      ] : null,
      'errors' => $errors,
      'pageTitle' => 'Gestion des Comptes > Consultation de solde',
      'activeSection' => 'solde'
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
