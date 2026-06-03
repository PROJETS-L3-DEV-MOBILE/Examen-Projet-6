<?php

use App\Config\Database;
use App\Config\Router;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$db = (new Database())->getConnection();
Router::dispatch($db);
