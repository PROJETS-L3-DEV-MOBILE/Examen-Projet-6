<?php
namespace App\Services;

use App\Models\TransactionType;
use App\Repositories\CompteRepository;
use App\Repositories\TransactionRepository;

class TransactionService
{
  public function __construct(
    private \PDO $db,
    private TransactionRepository $transactionRepository,
    private CompteRepository $compteRepository
  ) {
  }

  public function deposit(int $numCompte, float $montant): void
  {
    $compte = $this->compteRepository->getByNumCompte($numCompte);
    if (!$compte) {
      throw new \Exception("Compte with num_compte $numCompte not found");
    }

    try {

      $this->db->beginTransaction();

      $this->transactionRepository->create(
        numCompteSource: null,
        numCompteDestination: $numCompte,
        typeTransaction: TransactionType::DEPOSIT,
        montant: $montant,
        dateTransaction: new \DateTime()
      );

      $this->compteRepository->addSolde($numCompte, $montant);
      $this->db->commit();

    } catch (\Exception $e) {
      $this->db->rollBack();
      throw $e;
    }
  }

  public function withdraw(int $numCompte, float $montant): void
  {
    $compte = $this->compteRepository->getByNumCompte($numCompte);
    if (!$compte) {
      throw new \Exception("Compte $numCompte introuvable");
    }
    if ($compte->getSoldeActuel() < $montant) {
      throw new \Exception("Solde insuffisant pour le retrait");
    }

    try {

      $this->db->beginTransaction();

      $this->transactionRepository->create(
        numCompteSource: $numCompte,
        numCompteDestination: null,
        typeTransaction: TransactionType::WITHDRAWAL,
        montant: $montant,
        dateTransaction: new \DateTime()
      );

      $this->compteRepository->subtractSolde($numCompte, $montant);
      $this->db->commit();

    } catch (\Exception $e) {
      $this->db->rollBack();
      throw $e;
    }
  }

  public function transfer(int $numCompteSource, int $numCompteDestination, float $montant): void
  {
    $compteSource = $this->compteRepository->getByNumCompte($numCompteSource);
    $compteDestination = $this->compteRepository->getByNumCompte($numCompteDestination);

    if (!$compteSource) {
      throw new \Exception("Compte source $numCompteSource introuvable");
    }
    if (!$compteDestination) {
      throw new \Exception("Compte destination $numCompteDestination introuvable");
    }
    if ($compteSource->getSoldeActuel() < $montant) {
      throw new \Exception("Solde insuffisant pour le virement");
    }

    try {

      $this->db->beginTransaction();

      $this->transactionRepository->create(
        numCompteSource: $numCompteSource,
        numCompteDestination: $numCompteDestination,
        typeTransaction: TransactionType::TRANSFER,
        montant: $montant,
        dateTransaction: new \DateTime()
      );

      $this->compteRepository->subtractSolde($numCompteSource, $montant);
      $this->compteRepository->addSolde($numCompteDestination, $montant);
      $this->db->commit();

    } catch (\Exception $e) {
      $this->db->rollBack();
      throw $e;
    }
  }

  // Aliases pour compatibilité
  public function depot(int $numCompte, float $montant): void
  {
    $this->deposit($numCompte, $montant);
  }

  public function retrait(int $numCompte, float $montant): void
  {
    $this->withdraw($numCompte, $montant);
  }

  public function virement(int $numCompteSource, int $numCompteDestination, float $montant): void
  {
    $this->transfer($numCompteSource, $numCompteDestination, $montant);
  }
}