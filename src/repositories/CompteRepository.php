<?php
namespace App\Repositories;

use App\Models\AccountStatus;
use App\Models\AccountType;
use App\Models\Compte;
use App\Models\TransactionStatus;

class CompteRepository
{

  public function __construct(private \PDO $db)
  {
  }

  public function create(int $numClient, AccountType $typeCompte, float $soldeInitial, AccountStatus $statutCompte = AccountStatus::ACTIVE): int
  {
    $stmt = $this->db->prepare('
      INSERT INTO comptes (num_client, type_compte, solde_actuel, statut_compte, taux_interet) 
      VALUES (:num_client, :type_compte, :solde, :statut, :taux)'
    );
    $stmt->execute([
      ':num_client' => $numClient,
      ':type_compte' => $typeCompte->value,
      ':solde' => $soldeInitial,
      ':statut' => $statutCompte->value,
      ':taux' => $typeCompte === AccountType::SAVINGS ? 0.02 : 0.01
    ]);
    return (int) $this->db->lastInsertId();
  }

  public function getByNumCompte(int $numCompte): ?Compte
  {
    $stmt = $this->db->prepare('SELECT * FROM comptes WHERE num_compte = :num_compte');
    $stmt->execute([':num_compte' => $numCompte]);
    $data = $stmt->fetch(\PDO::FETCH_ASSOC);
    if ($data) {
      return new Compte(
        (int) $data['num_compte'],
        (int) $data['num_client'],
        AccountType::from($data['type_compte']),
        (float) $data['solde_actuel'],
        new \DateTime($data['date_ouverture']),
        isset($data['date_fermeture']) ? new \DateTime($data['date_fermeture']) : null,
        (float) $data['taux_interet'],
        AccountStatus::from($data['statut_compte'])
      );
    }
    return null;
  }

  public function addSolde(int $numCompte, float $montant): void
  {
    $stmt = $this->db->prepare('UPDATE comptes SET solde_actuel = solde_actuel + :montant WHERE num_compte = :num_compte');
    $stmt->execute([
      ':montant' => $montant,
      ':num_compte' => $numCompte
    ]);
  }

  public function subtractSolde(int $numCompte, float $montant): void
  {
    $stmt = $this->db->prepare('UPDATE comptes SET solde_actuel = solde_actuel - :montant WHERE num_compte = :num_compte');
    $stmt->execute([
      ':montant' => $montant,
      ':num_compte' => $numCompte
    ]);
  }

  public function updateStatus(int $numCompte, AccountStatus $statut): void
  {
    $stmt = $this->db->prepare('UPDATE comptes SET statut = :statut WHERE num_compte = :num_compte');
    $stmt->execute([
      ':statut' => $statut->value,
      ':num_compte' => $numCompte
    ]);
  }


  public function getPendingTransactions(int $numCompte): int
  {
    $stmt = $this->db->prepare('SELECT COUNT(*) FROM transactions WHERE num_compte = :num_compte AND statut = :statut');
    $stmt->execute([
      ':num_compte' => $numCompte,
      ':statut' => TransactionStatus::PENDING->value
    ]);
    return (int) $stmt->fetch(\PDO::FETCH_COLUMN);
  }

  public function getAll(): array
  {
    $stmt = $this->db->prepare('SELECT * FROM comptes');
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
  }

  public function delete(int $numCompte): void
  {
    $stmt = $this->db->prepare('DELETE FROM comptes WHERE num_compte = :num_compte');
    $stmt->execute([':num_compte' => $numCompte]);
  }
}