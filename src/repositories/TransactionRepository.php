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

    if ($dateTransaction < new \DateTime()) {
      throw new \Exception("La date de transaction ne peut pas être dans le passé");
    }

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
}