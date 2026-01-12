# 🔐 TalentHub – Socle d’Authentification MVC (PHP sans framework)

## 📌 Présentation du projet

**TalentHub** est une plateforme de recrutement en cours de développement, destinée à connecter **candidats** et **recruteurs** de manière simple et efficace.

Ce dépôt correspond au **socle technique d’authentification multi-rôles**, conçu comme une base solide, réutilisable et extensible avant l’implémentation des fonctionnalités métier (offres d’emploi, candidatures, messagerie, etc.).

L’architecture repose sur un **MVC “fait maison”**, développé **sans framework**, avec un fort accent sur la séparation des responsabilités, la sécurité et la maintenabilité.

---

## 🎯 Objectif principal

👉 Mettre en place un **système d’authentification sécurisé et multi-rôles**, servant de fondation à l’ensemble de la plateforme TalentHub.

---

## 🧠 Objectifs pédagogiques

À l’issue de ce projet, vous serez capable de :

* Comprendre et implémenter une architecture **MVC sans framework**
* Mettre en place un **routeur centralisé**
* Séparer clairement :

    * **Models** : logique métier & accès aux données
    * **Controllers** : traitement des requêtes
    * **Views** : affichage uniquement
* Implémenter une **authentification multi-rôles**
* Protéger les routes selon le rôle utilisateur
* Comparer les avantages du MVC face à une approche procédurale
  *(maintenabilité, évolutivité, testabilité)*

---

## 👥 Rôles du système

### 👤 Candidate (Candidat)

* Inscription sur la plateforme
* Connexion
* Accès à un **dashboard candidat**

### 🏢 Recruiter (Recruteur)

* Inscription pour représenter une entreprise
* Connexion
* Accès à un **dashboard recruteur**

### 🛡️ Admin

* Connexion uniquement (pas d’inscription publique)
* Accès à un **back-office admin**
* Aucune vue partagée avec les autres rôles

⚠️ Chaque rôle possède :

* Ses propres routes (`/candidate/*`, `/recruiter/*`, `/admin/*`)
* Ses propres contrôleurs
* Ses propres vues protégées

---

## ⚙️ Fonctionnalités implémentées

### 🔐 Authentification

* Inscription (Candidate & Recruiter)
* Choix du rôle à l’inscription
* Validation des données (email, mot de passe)
* Connexion pour tous les rôles
* Création et gestion de session PHP
* Déconnexion et destruction de session
* Hashage sécurisé des mots de passe (`password_hash()`)

### 🔑 Gestion des rôles

* Attribution automatique du rôle
* Stockage du rôle en session
* Redirection après connexion :

  ```
  /{role}/dashboard
  ```
* Vérification du rôle à chaque requête protégée

### 🚫 Protection des routes

#### Routes publiques

* `/` → Page d’accueil
* `/register` → Inscription
* `/login` → Connexion

#### Routes protégées

* `/candidate/*` → Candidate uniquement
* `/recruiter/*` → Recruiter uniquement
* `/admin/*` → Admin uniquement

Contrôles systématiques :

* Utilisateur connecté ?
* Rôle autorisé ?
* Sinon → redirection vers **403** ou **login**

---

## 🏗️ Architecture du projet

### 📁 Structure des dossiers

```
project/
│
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Views/
│   └── Core/
│       ├── Router.php
│       ├── Controller.php
│       └── Database.php
│
├── public/
│   └── index.php   ← Point d’entrée unique
│
├── database/
│   └── schema.sql
│
└── README.md
```

### 🔁 Flux de requête

```
index.php
   ↓
Router
   ↓
Controller
   ↓
Model (si nécessaire)
   ↓
View
```

---

## 🧩 UML (obligatoire avant le code)

### 1️⃣ Diagramme de cas d’utilisation

* Inscription (Candidate, Recruiter)
* Connexion (tous les rôles)
* Accès dashboard selon rôle
* Déconnexion

### 2️⃣ Diagramme de classes

**User**

* id
* name
* email
* password
* role_id
* authenticate()
* hasRole()

**Role**

* id
* name

Relation :
`User → belongsTo → Role`

---

## 🔐 Sécurité & contraintes

### ✅ Obligatoire

* Hashage des mots de passe (`password_hash`)
* Vérification de session sur chaque route protégée
* PDO + requêtes préparées
* Validation des entrées utilisateur
* Messages d’erreur sécurisés

### ❌ Interdit

* Mots de passe en clair
* Rôles hardcodés
* Accès direct aux fichiers
* SQL dans les contrôleurs
* Logique métier dans les vues
* Code procédural dans les contrôleurs

---

## 🎯 Bonus (optionnel)

* Remember Me (cookie sécurisé)
* Log des tentatives de connexion
* Validation JavaScript côté client
* Pages 404 et 403 personnalisées

---

## 🏁 Résultat attendu

À la fin du projet, vous devez être capable de :

* ✅ Expliquer et justifier l’architecture MVC
* ✅ Ajouter un nouveau rôle sans casser l’existant
* ✅ Démontrer la supériorité du MVC sur le procédural
* ✅ Réutiliser ce système d’authentification dans tout projet PHP

---

## 📌 Auteur

Projet réalisé dans un contexte pédagogique pour la plateforme **TalentHub**.

---

💡 *Ce socle est conçu pour évoluer : il constitue la base de toutes les futures fonctionnalités de la plateforme.*
