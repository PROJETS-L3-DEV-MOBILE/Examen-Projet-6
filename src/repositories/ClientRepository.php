<?php
namespace App\Repositories;

class ClientRepository
{

  public function __construct(private \PDO $db)
  {
  }

  public function findByNumClient(int $numClient)
  {
    $stmt = $this->db->prepare('SELECT * FROM clients WHERE num_client = :num_client');
    $stmt->execute([':num_client' => $numClient]);
    return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
  }

  public function findByName(string $nom): array
  {
    $stmt = $this->db->prepare('SELECT * FROM clients WHERE nom = :nom');
    $stmt->execute([':nom' => $nom]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function findByFirstName(string $prenom): array
  {
    $stmt = $this->db->prepare('SELECT * FROM clients WHERE prenom = :prenom');
    $stmt->execute([':prenom' => $prenom]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function findByEmail(string $email): array
  {
    $stmt = $this->db->prepare('SELECT * FROM clients WHERE email = :email');
    $stmt->execute([':email' => $email]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function findByAccountNumber(int $numCompte): ?array
  {
    $stmt = $this->db->prepare('
      SELECT c.* 
      FROM clients c 
      JOIN comptes co ON c.num_client = co.num_client 
      WHERE co.num_compte = :num_compte
    ');
    $stmt->execute([':num_compte' => $numCompte]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
  }

  public function create(
    string $nom,
    string $prenom,
    string $adresse,
    string $email,
    string $telephone,
    \DateTime $dateNaissance,
    string $mdp
  ): int {
    $stmt = $this->db->prepare('INSERT INTO clients (nom, prenom, adresse, email, telephone, date_naissance, mdp) VALUES (:nom, :prenom, :adresse, :email, :telephone, :date_naissance, :mdp)');
    $stmt->execute([
      ':nom' => $nom,
      ':prenom' => $prenom,
      ':adresse' => $adresse,
      ':email' => $email,
      ':telephone' => $telephone,
      ':date_naissance' => $dateNaissance->format('Y-m-d'),
      ':mdp' => $mdp
    ]);
    return (int) $this->db->lastInsertId();
  }

  public function delete(int $numClient): void
  {
    $stmt = $this->db->prepare('DELETE FROM clients WHERE num_client = :num_client');
    $stmt->execute([':num_client' => $numClient]);
  }
}