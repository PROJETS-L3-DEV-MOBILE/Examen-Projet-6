<?php

namespace App\Services;

use App\Models\AccountStatus;
use App\Models\AccountType;
use App\Repositories\ClientRepository;
use App\Repositories\CompteRepository;

class AuthService
{

  public function __construct(
    private ClientRepository $clientRepository,
    private CompteRepository $compteRepository
  ) {
  }


  public function isAuthenticated(): bool
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    return isset($_SESSION['num_client']);
  }

  public function login(string $numClient, string $password): bool
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $client = $this->clientRepository->findByNumClient($numClient);
    if ($client === null) {
      return false;
    }

    if (!password_verify($password, $client['mdp'])) {
      return false;
    }

    $_SESSION['num_client'] = $client['num_client'];
    $_SESSION['nom'] = $client['nom'];
    $_SESSION['prenom'] = $client['prenom'];
    $_SESSION['adresse'] = $client['adresse'];
    $_SESSION['email'] = $client['email'];
    $_SESSION['telephone'] = $client['telephone'];
    $_SESSION['date_naissance'] = $client['date_naissance'];

    return true;
  }

  public function registerClient(string $nom, string $prenom, string $adresse, string $email, string $telephone, \DateTime $dateNaissance, string $mdp): bool
  {

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $num_client = $this->clientRepository->create($nom, $prenom, $adresse, $email, $telephone, $dateNaissance, password_hash($mdp, PASSWORD_DEFAULT));

    $_SESSION['num_client'] = $num_client;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $_SESSION['adresse'] = $adresse;
    $_SESSION['email'] = $email;
    $_SESSION['telephone'] = $telephone;
    $_SESSION['date_naissance'] = $dateNaissance->format('Y-m-d');
    return true;
  }

  public function createAccount(int $numClient, string $mdp, AccountType $accountType): bool
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $client = $this->clientRepository->findByNumClient($numClient);
    if ($client === null) {
      return false;
    }

    if (!password_verify($mdp, $client['mdp'])) {
      return false;
    }

    $this->compteRepository->create($numClient, $accountType, 0, AccountStatus::ACTIVE);

    return true;
  }

  public function logout(): bool
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $_SESSION = [];
    session_destroy();

    return true;
  }
}