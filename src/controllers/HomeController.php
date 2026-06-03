<?php

namespace App\Controllers;

use App\Services\AuthService;

class HomeController
{
    public function __construct(private AuthService $authService)
    {
    }

    public function index(): void
    {
        $isAuthenticated = $this->authService->isAuthenticated();

        $this->render('home', $isAuthenticated, $_SESSION['nom'] . ' ' . $_SESSION['prenom'], 0);
    }

    private function render(string $view, bool $isAuthenticated, ?string $username, int $activeIndex): void
    {
        ob_start();
        include __DIR__ . '/../views/' . $view . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../views/layout.php';
    }
}
