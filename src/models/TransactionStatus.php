<?php
namespace App\Models;

enum TransactionStatus: string
{
  case COMPLETED = 'validé';
  case CANCELED = 'annulé';
  case PENDING = 'en attente';
}
