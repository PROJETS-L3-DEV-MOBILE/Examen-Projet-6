<?php
namespace App\Models;

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