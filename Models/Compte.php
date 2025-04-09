<?php

require_once __DIR__ . '/../Lib/Database.php';


class Compte
{
    private int $id_compte;
    private string $rib;
    private string $type_compte;
    private float $solde_initial;
    private int $id_utilisateur;

    // Ces deux champs seront ajoutés dynamiquement
    public string $client_nom = '';
    public string $client_prenom = '';

    public function getIdCompte(): int { return $this->id_compte; }
    public function getRib(): string { return $this->rib; }
    public function getTypeCompte(): string { return $this->type_compte; }
    public function getSoldeInitial(): float { return $this->solde_initial; }
    public function getIdUtilisateur(): int { return $this->id_utilisateur; }

    public function setIdCompte(int $id_compte): void { $this->id_compte = $id_compte; }
    public function setRib(string $rib): void { $this->rib = htmlspecialchars($rib); }
    public function setTypeCompte(string $type_compte): void { $this->type_compte = htmlspecialchars($type_compte); }
    public function setSoldeInitial(float $solde_initial): void { $this->solde_initial = $solde_initial; }
    public function setIdUtilisateur(int $id_utilisateur): void { $this->id_utilisateur = $id_utilisateur; }
}
