# Documentation de l'API

L'API est construite avec **Laravel** et est disponible sur l'URL :

http://127.0.0.1:8000/api/

---

## Routes API

### 1️⃣ Créer un utilisateur

- **URL** : `/api/users`  
- **Méthode** : `POST`  
- **Exemple de payload** :

```json
{
  "first_name": "John",
  "last_name": "Doe",
  "birthdate": "1990-01-01",
  "current_job": "Engineer"
}
```
- **Réponse** :
```json
{
  "success": true,
  "data": {
    "id": 1,
    "first_name": "John",
    "last_name": "Doe",
    "birthdate": "1990-01-01",
    "current_job": "Engineer"
  }
}
```

### 2️⃣ Obtenir la liste des utilisateurs

- **URL** : `/api/users`  
- **Méthode** : `GET`  
- **Réponse** :

```json
{
  "data": [
    {
      "id": 1,
      "first_name": "John",
      "last_name": "Doe",
      "birthdate": "1990-01-01",
      "current_job": "Engineer"
    },
    {
      "id": 2,
      "first_name": "Jane",
      "last_name": "Doe",
      "birthdate": "1993-02-01",
      "current_job": "Designer"
    }
  ]
}
```

### 3️⃣  Obtenir les emplois d'un utilisateur spécifique

- **URL** : `/api/users/{userId}/job`  
- **Méthode** : `GET`  
- **Réponse** :

```json
{
  "data": [
    {
      "id": 1,
      "job_title": "Engineer",
      "start_date": "2022-01-01"
    }
  ]
}
```
### 4️⃣  Ajouter un emploi pour un utilisateur

- **URL** : `/api/users/{userId}/job`  
- **Méthode** : `POST`  
- **Réponse** :

```json
{
  "job_title": "Manager",
  "start_date": "2023-01-01"
}
```
### 5️⃣  Obtenir les emplois d'un utilisateur entre deux dates

- **URL** : `/api/users/{userId}/jobs/between/{startDate}/{endDate}`  
- **Méthode** : `GET`  
- **Réponse** :

```json

{
  "data": [
    {
      "job_title": "Manager",
      "start_date": "2023-01-01",
      "end_date": "2023-12-31"
    }
  ]
}
```

# 📋 **User Management System**

Bienvenue dans le projet **User Management System**.  
Ce projet utilise un backend Laravel comme API REST et un frontend Vue.js pour la partie interface utilisateur.  
Ce document contient les étapes pour configurer le projet, lancer l'API et la partie frontend ainsi que la documentation de l'API.

---

## 🚀 **Objectifs**

- **Backend :** Fournir une API avec Laravel pour la gestion des utilisateurs.
- **Frontend :** Interface avec Vue.js pour interagir avec l'API.
- **Base de données :** Configuration avec migrations et Faker pour tester facilement l'API.

---

## 🛠️ **Technologies utilisées**

- **Backend :** Laravel (PHP).
- **Frontend :** Vue.js.
- **Base de données :** MySQL/SQLite.
- **Gestion de dépendances :** Composer, npm.

---

## 🏗️ **Prérequis**

Avant de configurer le projet, assurez-vous d'avoir installé les outils suivants :

- **PHP >= 8.0**  
- **Composer** - [Installer Composer ici](https://getcomposer.org/)
- **Node.js et npm** - [Installer Node.js ici](https://nodejs.org/)
- **Base de données** - MySQL ou SQLite.

---

## 📥 **Installation**

### 1️⃣ **Backend (Laravel)**
```bsh
cd backend
composer install
cp .env.example .env
php artisan migrate --seed
php artisan serve
```
### 2️⃣ Frontend (Vue.js)**
```bsh
cd ../frontend
npm install
npm run serve
```



