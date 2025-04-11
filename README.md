# ECF_Banque
# Application de Gestion Bancaire

## ✨ Informations de Connexion

### Administrateur (accès total)
- **Email :** gilot.marie@hotmail.fr
- **Mot de passe :** 1234

### Utilisateur standard (accès personnel)
- **Email :** juju@me.com
- **Mot de passe :** 1234

---

## 📝 Présentation

Ce projet est une application web de **gestion bancaire** développée en PHP, suivant une architecture **MVC** claire et une logique de rôles (admin / utilisateur).
Elle répond à un **cahier des charges** précis établi pour digitaliser les processus d'une banque.

Elle permet :
- Une **authentification sécurisée**
- La gestion des **clients**
- La gestion des **comptes bancaires**
- La gestion des **contrats**
- Un **espace personnel** pour les clients (fonction ajoutée hors cahier des charges)

---

## ⚙️ Fonctionnalités

### Authentification
- Formulaire de connexion (email + mot de passe)
- Authentification par **hashage bcrypt**
- Sécurisation par **sessions PHP**
- Déconnexion

### Tableau de bord (Admin)
- Vue résumée : nombre de clients / comptes / contrats
- Accès rapide à chaque section

### Gestion des clients
- Création, modification, suppression
- Affichage détaillé
- Suppression impossible si le client possède au moins un compte ou contrat

### Gestion des comptes
- RIB, type de compte, solde initial, client associé
- Modification du type et du solde
- Suppression avec confirmation

### Gestion des contrats
- Type (Assurance, Crédit, CEL...), montant, durée, client associé
- Modification du montant et de la durée
- Suppression avec confirmation

### Espace personnel utilisateur
- Accès à ses infos, comptes et contrats (fonctionnalité ajoutée)

---

## 🔧 Technologies

- **PHP** (MVC)
- **MySQL** (base de données relationnelle)
- **HTML / CSS / JS**
- **PDO + requêtes préparées** (contre les injections SQL)
- **Sessions PHP**

---

## 📁 Arborescence du projet

```
ECF/
├── Controller/
│   ├── AuthController.php
│   ├── CompteController.php
│   ├── ContratController.php
│   ├── DashboardController.php
│   └── UserController.php
│
├── Js/
│   ├── client-list.js
│   ├── create-client.js
│   ├── create-compte.js
│   ├── create-contrat.js
│   ├── edit-client.js
│   ├── edit-compte.js
│   ├── edit-contrat.js
│   └── login.js
│
├── Lib/
│   ├── Database.php
│   └── utils.php
│
├── Models/
│   ├── Repositories/
│   │   ├── AdminRepository.php
│   │   ├── CompteRepository.php
│   │   ├── ContratRepository.php
│   │   └── UserRepository.php
│   ├── Admin.php
│   ├── Compte.php
│   ├── Contrat.php
│   ├── User.php
│   └── UserModel.php
│
├── SQL/
│   └── MPD.sql
│
├── View/
│   ├── css/
│   │   ├── client-list.css
│   │   ├── compte-list.css
│   │   ├── contrat-list.css
│   │   ├── create-client.css
│   │   ├── create-compte.css
│   │   ├── create-contrat.css
│   │   ├── dashboard.css
│   │   ├── edit-client.css
│   │   ├── edit-compte.css
│   │   ├── edit-contrat.css
│   │   ├── error.css
│   │   ├── header.css
│   │   ├── home-user.css
│   │   ├── login.css
│   │   ├── view-client.css
│   │   ├── view-compte.css
│   │   └── view-contrat.css
│   ├── Template/
│   │   ├── Footer.php
│   │   └── Header.php
│   ├── 403.php
│   ├── 404.php
│   ├── client-list.php
│   ├── compte-client-list.php
│   ├── compte-list.php
│   ├── contrat-list.php
│   ├── create-client.php
│   ├── create-compte.php
│   ├── create-contrat.php
│   ├── dashboard.php
│   ├── edit-client.php
│   ├── edit-compte.php
│   ├── edit-contrat.php
│   ├── home-user.php
│   ├── login.php
│   ├── view-client.php
│   ├── view-compte.php
│   └── view-contrat.php
│
└── index.php
```

---

## 👩‍💻 Auteur

Projet réalisé par **Chaimae LARAKI EL HOUSSAINI**
Dans le cadre d'un exercice de développement PHP/MVC.

---


