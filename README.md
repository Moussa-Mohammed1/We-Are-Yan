# We Are Yan

## Description

We Are Yan est une plateforme solidaire développée avec Laravel. Elle met en relation des bénéficiaires, des donateurs et des administrateurs autour d'annonces d'aide, de dons financiers ou matériels, d'événements solidaires et d'un système de messagerie.

Le code principal de l'application se trouve dans le dossier [Back-End](./Back-End).

## Fonctionnalités principales

- Authentification et gestion de profil utilisateur
- Gestion des rôles : `admin`, `beneficiaire`, `donateur`
- Création et gestion d'annonces par les bénéficiaires
- Validation ou rejet des annonces par l'administrateur
- Tableau de bord dédié pour chaque type d'utilisateur
- Dons en argent ou en nature
- Paiement des dons financiers via Stripe
- Suivi des statistiques de dons
- Participation à des événements solidaires
- Messagerie entre donateurs et bénéficiaires

## Structure du projet

- `Back-End/` : application principale Laravel
- `Cahier-de-Charge/` : documentation fonctionnelle du projet
- `diagrammes/` : diagrammes de cas d'utilisation et de classes

## Technologies utilisées

- PHP 8.3
- Laravel 13
- Laravel Breeze
- Laravel Reverb
- Stripe PHP SDK
- MySQL ou SQLite selon la configuration
- Vite
- Tailwind CSS
- Alpine.js

## Prérequis

Avant de lancer le projet, assurez-vous d'avoir installé :

- PHP 8.3 ou supérieur
- Composer
- Node.js et npm
- Une base de données compatible avec Laravel

## Installation

1. Cloner le dépôt :

```bash
git clone <url-du-depot>
cd We-Are-Yan
```

2. Aller dans le dossier de l'application :

```bash
cd Back-End
```

3. Installer les dépendances PHP :

```bash
composer install
```

4. Installer les dépendances front-end :

```bash
npm install
```

5. Copier le fichier d'environnement :

```bash
copy .env.example .env
```

6. Générer la clé de l'application :

```bash
php artisan key:generate
```

7. Configurer la base de données dans le fichier `.env`

8. Exécuter les migrations :

```bash
php artisan migrate
```

9. Lancer le serveur de développement :

```bash
composer run dev
```

Cette commande démarre Laravel, la file d'attente, les logs et Vite en parallèle.

## Variables d'environnement importantes

Selon les fonctionnalités utilisées, pensez à configurer :

- `APP_NAME`
- `APP_URL`
- `DB_*`
- `STRIPE_KEY`
- `STRIPE_SECRET`
- les variables de diffusion temps réel si Reverb est activé

## Tests

Pour lancer les tests :

```bash
cd Back-End
php artisan test
```

## Parcours utilisateur

### Bénéficiaire

- crée une annonce
- consulte ses annonces et les dons reçus
- configure ses informations de paiement
- échange avec les donateurs via la messagerie

### Donateur

- consulte les annonces approuvées
- effectue un don financier ou matériel
- participe à des événements
- suit son activité depuis son tableau de bord

### Administrateur

- supervise les utilisateurs
- valide ou rejette les annonces
- consulte les statistiques globales
- gère les événements

## Documentation complémentaire

- Cahier des charges : `Cahier-de-Charge/we-ara-yan.pdf`
- Diagrammes : dossier `diagrammes/`

## Licence

Ce projet utilise le framework Laravel, distribué sous licence MIT. La licence globale du projet peut être adaptée selon vos besoins.
