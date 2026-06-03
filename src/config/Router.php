<?php

namespace App\Config;

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\CompteController;
use App\Controllers\TransactionController;
use App\Controllers\HistoriqueController;
use App\Controllers\RechercheController;
use App\Controllers\StatistiquesController;
use App\Repositories\ClientRepository;
use App\Repositories\CompteRepository;
use App\Repositories\TransactionRepository;
use App\Services\AuthService;
use App\Services\CompteService;
use App\Services\TransactionService;

class Router
{
    public static function dispatch(\PDO $db): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $path = '/' . trim($path, '/');
        if ($path === '') {
            $path = '/';
        }

        // repositories
        $clientRepository = new ClientRepository($db);
        $compteRepository = new CompteRepository($db);
        $transactionRepository = new TransactionRepository($db);

        // services
        $authService = new AuthService($clientRepository, $compteRepository);
        $compteService = new CompteService($clientRepository, $compteRepository);
        $transactionService = new TransactionService($db, $transactionRepository, $compteRepository);

        // controllers
        $homeController = new HomeController($authService);
        $authController = new AuthController($authService, $compteService);
        $compteController = new CompteController($compteService, $compteRepository, $clientRepository);
        $transactionController = new TransactionController($transactionService, $compteRepository);
        $historiqueController = new HistoriqueController($compteRepository, $transactionRepository);
        $rechercheController = new RechercheController($clientRepository);
        $statistiquesController = new StatistiquesController($transactionRepository);

        $isAuthenticated = $authService->isAuthenticated();
        $isAuthenticated = true;

        /*
            'METHOD' => [
                '/route' => [ControllerInstance, 'methodName'],
            ],
        */
        $routes = [
            'GET' => [
                '/' => [
                    $isAuthenticated ? $homeController : $authController,
                    $isAuthenticated ? 'index' : 'showLoginForm'
                ],
                '/login' => [$authController, 'showLoginForm'],
                '/register-account' => [$authController, 'showRegisterAccountForm'],
                '/register-client' => [$authController, 'showRegisterClientForm'],
                '/logout' => [$authController, 'logout'],
                '/compte/ouverture' => [$compteController, 'ouverture'],
                '/compte/fermeture' => [$compteController, 'fermeture'],
                '/compte/solde' => [$compteController, 'solde'],
                '/transaction/depot' => [$transactionController, 'depot'],
                '/transaction/retrait' => [$transactionController, 'retrait'],
                '/transaction/virement' => [$transactionController, 'virement'],
                '/historique' => [$historiqueController, 'index'],
                '/historique/pdf' => [$historiqueController, 'pdf'],
                '/recherche' => [$rechercheController, 'index'],
                '/statistiques' => [$statistiquesController, 'index'],
            ],
            'POST' => [
                '/login' => [$authController, 'login'],
                '/register-client' => [$authController, 'registerClient'],
                '/register-account' => [$authController, 'registerAccount'],
                '/compte/ouverture' => [$compteController, 'ouverture'],
                '/compte/fermeture' => [$compteController, 'fermeture'],
                '/compte/solde' => [$compteController, 'solde'],
                '/transaction/depot' => [$transactionController, 'depot'],
                '/transaction/retrait' => [$transactionController, 'retrait'],
                '/transaction/virement' => [$transactionController, 'virement'],
                '/historique' => [$historiqueController, 'index'],
                '/recherche' => [$rechercheController, 'index'],
            ],
        ];

        if (isset($routes[$_SERVER['REQUEST_METHOD']][$path])) {
            $handler = $routes[$_SERVER['REQUEST_METHOD']][$path];
            $handler[0]->{$handler[1]}();
            return;
        }

        self::renderNotFound();
    }

    private static function renderNotFound(): void
    {
        header('HTTP/1.1 404 Not Found');
        require __DIR__ . '/../views/errors/404.php';
    }
}
