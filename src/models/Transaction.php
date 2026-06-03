<?php
namespace App\Models;

enum TransactionStatus: string
{
  case COMPLETED = 'validé';
  case CANCELED = 'annulé';
  case PENDING = 'en attente';
}

enum TransactionType: string
{
  case TRANSFER = 'virement';
  case DEPOSIT = 'dépôt';
  case WITHDRAWAL = 'retrait';
}

class Transaction
{
  public function __construct(
    private int $numTransaction,
    private int $numCompteSource,
    private int $numCompteDestination,
    private TransactionType $typeTransaction,
    private float $montant,
    private \DateTime $dateTransaction,
    private TransactionStatus $statutTransaction
  ) {
  }
}