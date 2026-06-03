<?php

namespace App\Services;

use App\Models\AccountStatus;
use App\Models\AccountType;
use App\Repositories\ClientRepository;
use App\Repositories\CompteRepository;

class CompteService
{
  public function __construct(
    private ClientRepository $clientRepository,
    private CompteRepository $compteRepository
  ) {
  }

  public function closeAccount(int $numCompte): void
  {
    $compte = $this->compteRepository->getByNumCompte($numCompte);
    $pendingTransactions = $this->compteRepository->getPendingTransactions($numCompte);

    if ($pendingTransactions > 0) {
      throw new \Exception("Ce compte a des transaction en cours.");
    }
    if (!$compte) {
      throw new \Exception("Compte $numCompte introuvable");
    }

    if ($compte->getSoldeActuel() != 0) {
      throw new \Exception("Ce compte a un solde non nul. Veuillez le vider avant de le fermer.");
    }

    $this->compteRepository->updateStatus($numCompte, AccountStatus::CLOSED);
  }

  public function findByName(string $name)
  {
    return $this->clientRepository->findByName($name);
  }

  public function findByFirstName(string $firstName)
  {
    return $this->clientRepository->findByFirstName($firstName);
  }

  public function findByPhoneNumber(int $accountNumber)
  {
    return $this->clientRepository->findByAccountNumber($accountNumber);
  }

  public function findByEmail(string $email)
  {
    return $this->clientRepository->findByEmail($email);
  }

  public function createCompte(int $numClient, AccountType $typeCompte, float $soldeInitial): int
  {
    return $this->compteRepository->create($numClient, $typeCompte, $soldeInitial);
  }
}
