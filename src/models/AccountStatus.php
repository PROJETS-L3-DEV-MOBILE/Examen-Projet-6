<?php
namespace App\Models;

enum AccountStatus: string
{
case ACTIVE = 'actif';
case CLOSED = 'fermé';
}