<?php
require_once __DIR__ . '/../Lib/Database.php'; // Correction du nom de la classe

class Admin
{
    private ?int $idAdmin;
    private string $nomAdmin;
    private string $email;
    private string $motDePasse;

    public function __construct(?int $idAdmin = null, string $nomAdmin = '', string $email = '', string $motDePasse = '')
    {
        $this->idAdmin = $idAdmin;
        $this->nomAdmin = $nomAdmin;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
    }

    public function getIdAdmin(): ?int
    {
        return $this->idAdmin;
    }

    public function setIdAdmin(?int $idAdmin): void
    {
        $this->idAdmin = $idAdmin;
    }

    public function getNomAdmin(): string
    {
        return $this->nomAdmin;
    }

    public function setNomAdmin(string $nomAdmin): void
    {
        $this->nomAdmin = $nomAdmin;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMotDePasse(): string
    {
        return $this->motDePasse;
    }

    public function setMotDePasse(string $motDePasse): void
    {
        $this->motDePasse = $motDePasse;
    }
}