
# 🏦 ECF_Banque – Application de Gestion Bancaire

## ✨ Informations de Connexion

### Administrateur (accès total)
- **Email :** gilot.marie@hotmail.fr
- **Mot de passe :** 1234

### Utilisateur standard (accès personnel > BONUS or cahier des charges)
- **Email :** juju@me.com
- **Mot de passe :** 1234

### Faux utilisateur (test redirection 403)
- **Email :** faux@mail.com
- **Mot de passe :** faux
- 👉 Redirigé automatiquement vers la **page 403** sans aucun accès

---

## 📝 Présentation

Ce projet est une application web de **gestion bancaire**, développée en PHP avec une architecture **MVC** claire et sécurisée.

Elle permet à une institution bancaire de gérer efficacement ses :
- **Clients**
- **Comptes bancaires**
- **Contrats**

Le tout via une **interface fluide**, **sécurisée**, et adaptée au rôle (admin ou utilisateur connecté).

### 💡 Bonus réalisés hors cahier des charges :
- Connexion utilisateur (client)
- Espace personnel avec comptes et contrats
- Suppression en cascade des données clients

---

## ⚙️ Fonctionnalités

### 🔐 Authentification
- Connexion sécurisée avec **email + mot de passe hashé (bcrypt)**
- Rôles `admin` et `user` (client)
- Sessions PHP
- Redirection sécurisée : accès refusé → **403.php**

### 🧑‍💼 Tableau de bord (Admin)
- Vue synthétique du système :
  - Nombre de clients
  - Nombre de comptes
  - Nombre de contrats
- Tableau détaillé : comptes et contrats associés par client
- Navigation rapide

### 👥 Gestion des clients
- Ajouter un client
- Modifier ses informations
- Voir ses détails
- Supprimer un client :
  - **Tag v1.0 :** impossible si des comptes ou contrats sont liés
  - **Tag v2.0 :** suppression **en cascade** activée via SQL

### 💰 Gestion des comptes
- Saisie RIB, type de compte (courant / épargne), solde
- Attribution à un client
- Modification possible (type, solde)
- Suppression avec message de confirmation

### 📑 Gestion des contrats
- Type (Assurance Vie, Crédit Immobilier, CEL...)
- Montant et durée
- Attribution à un client
- Modification et suppression

### 👤 Espace personnel (utilisateur connecté)
**Fonctionnalité ajoutée hors cahier des charges**

Permet à un client connecté de :
- Voir ses informations personnelles
- Accéder à ses comptes
- Visualiser ses contrats

---

## 🏷️ Historique des versions

| Tag Git | Description |
|---------|-------------|
| `v1.0` | Version initiale conforme au cahier des charges – suppression bloquée si client a des comptes ou contrats |
| `v2.0` | Version bonus – suppression **en cascade** (comptes & contrats supprimés avec le client) via `ON DELETE CASCADE` |

---

## 🧪 Technologies utilisées

- **PHP** avec architecture MVC
- **MySQL** avec PDO (requêtes préparées)
- **HTML / CSS / JavaScript**
- **Session sécurisée**
- **Password hashing (bcrypt)**

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

## 📄 Livrables

- ✅ MCD / MLD (MERISE)
- ✅ Script SQL de création de la base
- ✅ Projet MVC complet avec DAO
- ✅ Authentification sécurisée
- ✅ Deux tags Git (`v1.0`, `v2.0`)
- ✅ Espace utilisateur
- ✅ README documenté

---

## 🧑‍💻 Réalisé par

**Chaimae LARAKI EL HOUSSAINI**  
📆 Projet réalisé du 7 au 11 avril 2025  
🎓 ECF – Développeur web & web mobile

---

## ✅ Respect du cahier des charges

| Exigence | Réalisée |
|----------|----------|
| Architecture MVC | ✅ |
| DAO (Data Access Object) | ✅ |
| Authentification admin | ✅ |
| CRUD client / compte / contrat | ✅ |
| Requêtes sécurisées (PDO) | ✅ |
| Hash mot de passe | ✅ |
| Gestion des rôles | ✅ |
| Interface responsive et ergonomique | ✅ |
| Bonus : Espace utilisateur | ✅ |
| Bonus : Suppression en cascade | ✅ |

---
