<?php
namespace App\Models;

enum TransactionType: string
{
  case TRANSFER = 'virement';
  case DEPOSIT = 'dépôt';
  case WITHDRAWAL = 'retrait';
}