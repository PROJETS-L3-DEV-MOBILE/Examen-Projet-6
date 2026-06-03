<?php
namespace App\Models;

class Client
{
  public function __construct(
    private int $numClient,
    private string $nom,
    private string $prenom,
    private string $adresse,
    private string $email,
    private string $telephone,
    private \DateTime $dateNaissance,
    private string $mdp
  ) {
  }

  public function getNumClient(): int
  {
    return $this->numClient;
  }

  public function getNom(): string
  {
    return $this->nom;
  }

  public function getPrenom(): string
  {
    return $this->prenom;
  }

  public function getAdresse(): string
  {
    return $this->adresse;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function getTelephone(): string
  {
    return $this->telephone;
  }

  public function getDateNaissance(): \DateTime
  {
    return $this->dateNaissance;
  }

  public function getMdp(): string
  {
    return $this->mdp;
  }

  public function copyWith(
    ?int $numClient = null,
    ?string $nom = null,
    ?string $prenom = null,
    ?string $adresse = null,
    ?string $email = null,
    ?string $telephone = null,
    ?\DateTime $dateNaissance = null,
    ?string $mdp = null
  ): Client {
    return new Client(
      $numClient ?? $this->numClient,
      $nom ?? $this->nom,
      $prenom ?? $this->prenom,
      $adresse ?? $this->adresse,
      $email ?? $this->email,
      $telephone ?? $this->telephone,
      $dateNaissance ?? $this->dateNaissance,
      $mdp ?? $this->mdp
    );
  }
}
