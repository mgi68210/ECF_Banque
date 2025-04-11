<?php

class Contrat
{
    private int $id_contrat;
    private string $type_contrat;
    private float $montant;
    private int $duree;
    private int $id_utilisateur;

    public string $client_nom = '';
    public string $client_prenom = '';

    public function getIdContrat(): int { return $this->id_contrat; }
    public function getTypeContrat(): string { return $this->type_contrat; }
    public function getMontant(): float { return $this->montant; }
    public function getDuree(): int { return $this->duree; }
    public function getIdUtilisateur(): int { return $this->id_utilisateur; }

    public function setIdContrat(int $id): void { $this->id_contrat = $id; }
    public function setTypeContrat(string $type): void { $this->type_contrat = htmlspecialchars($type); }
    public function setMontant(float $montant): void { $this->montant = $montant; }
    public function setDuree(int $duree): void { $this->duree = $duree; }
    public function setIdUtilisateur(int $id): void { $this->id_utilisateur = $id; }
}
