<?php

namespace App\Config;

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Repositories\ClientRepository;
use App\Repositories\CompteRepository;
use App\Repositories\TransactionRepository;
use App\Services\AuthService;
use App\Services\CompteService;
use App\Services\TransactionService;
use App\Services\UserService;

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

        $isAuthenticated = $authService->isAuthenticated();

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
            ],
            'POST' => [
                '/login' => [$authController, 'login'],
                '/register-client' => [$authController, 'registerClient'],
                '/register-account' => [$authController, 'registerAccount'],
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
