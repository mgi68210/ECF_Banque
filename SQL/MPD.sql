#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Utilisateur
#------------------------------------------------------------

CREATE TABLE Utilisateur(
        id_utilisateur Int  Auto_increment  NOT NULL ,
        nom            Varchar (100) NOT NULL ,
        prenom         Varchar (100) NOT NULL ,
        email          Varchar (100) NOT NULL ,
        telephone      Numeric NOT NULL ,
        adresse        Varchar (100) NOT NULL
	,CONSTRAINT Utilisateur_PK PRIMARY KEY (id_utilisateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Compte Bancaire
#------------------------------------------------------------

CREATE TABLE Compte_Bancaire(
        id_compte      Int  Auto_increment  NOT NULL ,
        rib            Varchar (100) NOT NULL ,
        type_compte    Varchar (100) NOT NULL ,
        solde_initial  Numeric NOT NULL ,
        id_utilisateur Int NOT NULL
	,CONSTRAINT Compte_Bancaire_PK PRIMARY KEY (id_compte)

	,CONSTRAINT Compte_Bancaire_Utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: contrat
#------------------------------------------------------------

CREATE TABLE contrat(
        id_contrat         Int  Auto_increment  NOT NULL ,
        type_contrat       Varchar (100) NOT NULL ,
        montant_du_contrat Numeric NOT NULL ,
        Duree_du_contrat   Numeric NOT NULL ,
        id_utilisateur     Int NOT NULL
	,CONSTRAINT contrat_PK PRIMARY KEY (id_contrat)

	,CONSTRAINT contrat_Utilisateur_FK FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Admin
#------------------------------------------------------------

CREATE TABLE Admin(
        id_admin     Int  Auto_increment  NOT NULL ,
        nom_admin    Varchar (50) NOT NULL ,
        email        Varchar (100) NOT NULL ,
        mot_de_passe Varchar (50) NOT NULL
	,CONSTRAINT Admin_PK PRIMARY KEY (id_admin)
)ENGINE=InnoDB;

ALTER TABLE Admin
MODIFY COLUMN mot_de_passe VARCHAR(255) NOT NULL;

UPDATE Admin
SET mot_de_passe = '$2y$10$oJcHSo3IxqdRx1jG5Xf9QuS6gGWOq3mCYi5JlKKnksx63Qs8TGQWy'
WHERE email = 'gilot.marie@hotmail.fr';

ALTER TABLE utilisateur ADD COLUMN role ENUM('admin', 'user') DEFAULT 'user';

ALTER TABLE utilisateur
ADD COLUMN password VARCHAR(255) NULL;