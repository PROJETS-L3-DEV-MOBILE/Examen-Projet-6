<?php
namespace App\Repositories;

use App\Models\TransactionType;
use App\Models\TransactionStatus;


class TransactionRepository
{
  public function __construct(private \PDO $db)
  {
  }

  public function create(
    ?int $numCompteSource,
    ?int $numCompteDestination,
    float $montant,
    \DateTime $dateTransaction,
    TransactionType $typeTransaction,
  ): int {

    if ($numCompteSource === null && $typeTransaction !== TransactionType::DEPOSIT) {
      throw new \Exception("Le compte source doit être spécifié pour les transactions autres que les dépôts");
    }

    if ($numCompteDestination === null && $typeTransaction !== TransactionType::WITHDRAWAL) {
      throw new \Exception("Le compte destination doit être spécifié pour les transactions autres que les retraits");
    }

    $statutTransaction = $dateTransaction > new \DateTime() ? TransactionStatus::PENDING : TransactionStatus::COMPLETED;

    $stmt = $this->db->prepare('INSERT INTO transactions (num_compte_source, num_compte_destination, type_transaction, montant, date_transaction, statut_transaction) VALUES (:num_compte_source, :num_compte_destination, :type_transaction, :montant, :date_transaction, :statut_transaction)');
    $stmt->execute([
      ':num_compte_source' => $numCompteSource,
      ':num_compte_destination' => $numCompteDestination,
      ':type_transaction' => $typeTransaction->value,
      ':montant' => $montant,
      ':date_transaction' => $dateTransaction->format('Y-m-d'),
      ':statut_transaction' => $statutTransaction->value
    ]);
    return (int) $this->db->lastInsertId();
  }

  public function getAll(\DateTime $startDate, \DateTime $endDate): array
  {
    $stmt = $this->db->prepare('SELECT * FROM transactions WHERE date_transaction BETWEEN :start_date AND :end_date');
    $stmt->execute([
      ':start_date' => $startDate->format('Y-m-d'),
      ':end_date' => $endDate->format('Y-m-d')
    ]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getDepotDetails(\DateTime $startDate, \DateTime $endDate): array
  {
    $stmt = $this->db->prepare('
      SELECT t.*, c.num_client AS num_client_source, c2.num_client AS num_client_destination
      FROM transactions t
      JOIN comptes co ON t.num_compte_source = co.num_compte
      JOIN clients c ON co.num_client = c.num_client
      JOIN comptes co2 ON t.num_compte_destination = co2.num_compte
      JOIN clients c2 ON co2.num_client = c2.num_client
      WHERE t.type_transaction = :type_transaction AND t.date_transaction BETWEEN :start_date AND :end_date
    ');
    $stmt->execute([
      ':type_transaction' => TransactionType::DEPOSIT->value,
      ':start_date' => $startDate->format('Y-m-d'),
      ':end_date' => $endDate->format('Y-m-d')
    ]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getMostActiveAccount(int $limit = 5): array
  {
    $stmt = $this->db->prepare('
      SELECT num_compte_source, COUNT(*) AS nb_transactions 
      FROM transactions 
      GROUP BY num_compte_source 
      ORDER BY nb_transactions DESC 
      LIMIT :limit
    ');
    $stmt->bindValue(':limit', $limit, \PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getAvgSoldeByAccountType(): array
  {
    $stmt = $this->db->prepare('
      SELECT co.type_compte, AVG(co.solde) AS avg_solde 
      FROM comptes co 
      GROUP BY co.type_compte
    ');
    $stmt->execute();
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getByNumCompte(int $numCompte): array
  {
    $stmt = $this->db->prepare('
      SELECT * FROM transactions 
      WHERE num_compte_source = :num_compte OR num_compte_destination = :num_compte
      ORDER BY date_transaction DESC
    ');
    $stmt->execute([':num_compte' => $numCompte]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
  }

  public function count(): int
  {
    $stmt = $this->db->prepare('SELECT COUNT(*) FROM transactions');
    $stmt->execute();
    return (int) $stmt->fetch(\PDO::FETCH_COLUMN);
  }

  public function getTotalMontant(): float
  {
    $stmt = $this->db->prepare('SELECT SUM(montant) FROM transactions WHERE statut_transaction = :statut');
    $stmt->execute([':statut' => TransactionStatus::COMPLETED->value]);
    return (float) ($stmt->fetch(\PDO::FETCH_COLUMN) ?? 0);
  }

  public function countByStatut(string $statut): int
  {
    $stmt = $this->db->prepare('SELECT COUNT(*) FROM transactions WHERE statut_transaction = :statut');
    $stmt->execute([':statut' => $statut]);
    return (int) $stmt->fetch(\PDO::FETCH_COLUMN);
  }

  public function countByType(): array
  {
    $stmt = $this->db->prepare('
      SELECT type_transaction, COUNT(*) as nombre, SUM(montant) as montant_total 
      FROM transactions 
      WHERE statut_transaction = :statut
      GROUP BY type_transaction
    ');
    $stmt->execute([':statut' => TransactionStatus::COMPLETED->value]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
  }

  public function countByDay(): array
  {
    $stmt = $this->db->prepare('
      SELECT DATE(date_transaction) as date, COUNT(*) as nombre, SUM(montant) as montant_total 
      FROM transactions 
      WHERE statut_transaction = :statut AND date_transaction >= DATE_SUB(NOW(), INTERVAL 7 DAY)
      GROUP BY DATE(date_transaction)
      ORDER BY date DESC
    ');
    $stmt->execute([':statut' => TransactionStatus::COMPLETED->value]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?? [];
  }
}