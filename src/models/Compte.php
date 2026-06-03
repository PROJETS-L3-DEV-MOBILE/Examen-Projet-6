<?php
namespace App\Models;

enum AccountType: string
{
  case CHECKING = 'courant';
  case SAVINGS = 'épargne';
}

enum AccountStatus: string
{
  case ACTIVE = 'actif';
  case CLOSED = 'fermé';
}

class Compte
{
  public function __construct(
    private int $numCompte,
    private int $numClient,
    private AccountType $typeCompte,
    private float $soldeActuel,
    private \DateTime $dateOuverture,
    private ?\DateTime $dateFermeture,
    private float $tauxInteret,
    private AccountStatus $statutCompte
  ) {
  }

  public function getNumCompte(): int
  {
    return $this->numCompte;
  }

  public function getNumClient(): int
  {
    return $this->numClient;
  }

  public function getSoldeActuel(): float
  {
    return $this->soldeActuel;
  }

  public function getTypeCompte(): AccountType
  {
    return $this->typeCompte;
  }

  public function getDateOuverture(): \DateTime
  {
    return $this->dateOuverture;
  }

  public function getDateFermeture(): ?\DateTime
  {
    return $this->dateFermeture;
  }

  public function getTauxInteret(): float
  {
    return $this->tauxInteret;
  }

  public function getStatutCompte(): AccountStatus
  {
    return $this->statutCompte;
  }

  public function copyWith(
    ?int $numCompte = null,
    ?int $numClient = null,
    ?string $typeCompte = null,
    ?float $soldeActuel = null,
    ?\DateTime $dateOuverture = null,
    ?\DateTime $dateFermeture = null,
    ?float $tauxInteret = null,
    ?string $statutCompte = null
  ): self {
    return new self(
      numCompte: $numCompte ?? $this->numCompte,
      numClient: $numClient ?? $this->numClient,
      typeCompte: $typeCompte ?? $this->typeCompte,
      soldeActuel: $soldeActuel ?? $this->soldeActuel,
      dateOuverture: $dateOuverture ?? $this->dateOuverture,
      dateFermeture: $dateFermeture ?? $this->dateFermeture,
      tauxInteret: $tauxInteret ?? $this->tauxInteret,
      statutCompte: $statutCompte ?? $this->statutCompte
    );
  }
}