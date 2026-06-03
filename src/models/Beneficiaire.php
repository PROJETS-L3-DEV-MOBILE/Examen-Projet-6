<?php
namespace App\Models;

class Beneficiaire
{
  public function __construct(
    private int $idBeneficiaire,
    private int $numClient,
    private int $numCompteBeneficiaire,
    private string $raison
  ) {

  }

  public function getIdBeneficiaire(): int
  {
    return $this->idBeneficiaire;
  }

  public function getNumClient(): int
  {
    return $this->numClient;
  }

  public function getNumCompteBeneficiaire(): int
  {
    return $this->numCompteBeneficiaire;
  }

  public function getRaison(): string
  {
    return $this->raison;
  }

}