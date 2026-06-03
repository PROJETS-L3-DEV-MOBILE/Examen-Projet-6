<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\CompteService;
use DateTime;

class AuthController
{
    public function __construct(
        private AuthService $authService,
        private CompteService $compteService
    ) {
    }

    public function showLoginForm(): void
    {
        $this->render('login', [], []);
    }

    public function showRegisterClientForm(): void
    {
        $this->render('register', [], []);
    }

    public function showRegisterAccountForm(): void
    {
        $this->render('register_account', [], []);
    }

    public function login(): void
    {
        $numClient = trim($_POST['num_client'] ?? '');
        $mdp = $_POST['mdp'] ?? '';

        if ($this->authService->login($numClient, $mdp)) {
            header('Location: /');
            exit;
        }

        $this->render('login', ['Email ou mot de passe incorrect.'], ['num_client' => $numClient, 'mdp' => $mdp]);
    }

    public function registerClient(): void
    {
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');
        $adresse = trim($_POST['adresse'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telephone = trim($_POST['telephone'] ?? '');
        $dateNaiss = new DateTime($_POST['date_naissance']);
        $mdp = $_POST['mdp'] ?? '';

        $errors = [];

        if ($nom === '' || $prenom === '' || $adresse === '' || $telephone === '' || $dateNaiss === null || $email === '' || $mdp === '') {
            $errors[] = 'Veuillez remplir tous les champs.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'L\'email est invalide.';
        }

        if (empty($errors)) {
            if (
                $this
                    ->authService
                    ->registerClient($nom, $prenom, $adresse, $email, $telephone, $dateNaiss, $mdp)
            ) {
                header('Location: /');
                exit;
            }
            $errors[] = 'Impossible de créer le compte, réessayez plus tard.';
        }

        $this->render(
            'register',
            $errors,
            [
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'telephone' => $telephone,
                'date_naissance' => $dateNaiss->format('Y-m-d'),
                'adresse' => $adresse,
                'mdp' => $mdp
            ]
        );
    }

    public function registerAccount(): void
    {
        $numClient = trim($_POST['num_client'] ?? '');
        $mdp = $_POST['mdp'] ?? '';
        $accountType = $_POST['account_type'] ?? '';

        if ($this->authService->createAccount((int) $numClient, $mdp, $accountType)) {
            header('Location: /');
            exit;
        }

        $this->render('register_account', ['Numéro de client ou mot de passe incorrect.'], ['num_client' => $numClient, 'mdp' => $mdp, 'account_type' => $accountType]);
    }

    public function logout(): void
    {
        $this->authService->logout();
        header('Location: /login');
        exit;
    }
    private function render(string $view, array $errors = [], array $old = []): void
    {
        include __DIR__ . '/../views/' . $view . '.php';
    }
}
