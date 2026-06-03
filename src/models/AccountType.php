<?php 
namespace App\Models;


enum AccountType: string
{
  case CHECKING = 'courant';
  case SAVINGS = 'épargne';
}