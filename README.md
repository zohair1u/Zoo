# 🐘 Zoo 

Zoo est une application web développée dans le cadre d'un projet fictif, dédié à la gestion complète d'un zoo. Ce projet permet aux utilisateurs d'explorer des informations détaillées sur les animaux, leurs habitats naturels, ainsi que les services proposés par le zoo, comme les visites guidées et les spectacles.

Conçu pour des objectifs pédagogiques, ce projet a été pensé pour offrir une gestion centralisée des informations sur les animaux, les espèces, les habitats et les services. Bien que le zoo soit fictif, l'application simule de manière réaliste la gestion d'un zoo moderne, permettant de démontrer les compétences en développement web.

🌍 Objectifs du projet :

Offrir une plateforme complète pour la gestion des animaux, habitats, espèces et services du zoo.
Permettre aux visiteurs de laisser des avis et consulter les services disponibles.
Créer un système sécurisé de gestion des rôles et des permissions pour les administrateurs et les employés du zoo.
Fournir une interface front-end responsive et adaptée aux appareils mobiles, grâce à l'utilisation de Bootstrap et CSS.

🚀 Principales fonctionnalités :

Gestion des animaux et de leurs espèces.
Visualisation des habitats et des informations associées.
Gestion des services proposés aux visiteurs (visites guidées, restaurant, etc.).
Système d'avis des visiteurs, modéré par les employés.
Interface d'administration permettant de gérer facilement les entités du zoo (animaux, services, avis, etc.).


## Tech Stack
### Client (Front-End) :
- Twig (Pour le moteur de templates Symfony)
- Bootstrap / CSS (Pour le design et la mise en page responsive)

### Server (Back-End) :
- Symfony 7.3 (Framework PHP)
- Doctrine ORM (Pour la gestion de la base de données)

### Base de données :
- MySQL (Pour les données relationnelles)
- MongoDB (Pour les données NoSQL, via MongoDB Atlas)

### Outils de développement :
- Composer (Gestion des dépendances PHP)

## Prérequis

Avant de pouvoir lancer le projet en local, assurez-vous d'avoir les outils suivants installés sur votre machine :

- PHP 8.2 : Symfony nécessite PHP pour fonctionner. Assurez-vous d'avoir une version compatible de PHP installée.
- Composer : Outil de gestion des dépendances PHP, utilisé pour installer les dépendances du projet.
- Installation de Composer : https://getcomposer.org/download/
- MySQL : Base de données relationnelle utilisée pour le projet.
- Installation de MySQL : https://dev.mysql.com/downloads/
- MongoDB : Base de données NoSQL utilisée pour certaines parties du projet.
- Installation de MongoDB : https://www.mongodb.com/try/download/community
- Symfony CLI (optionnel) : Utilisé pour faciliter le développement avec Symfony (serveur local, commandes Symfony, etc.).
- Installation de Symfony : https://symfony.com/download
- Assurez-vous également que votre serveur de base de données (MySQL et MongoDB) est démarré et que vous avez accès à ces services avant de lancer l'application.

## Installation
### 🔽 Cloner le projet

``` git clone https://github.com/zohair1u/Zoo.git ```

Aller dans le répertoire du projet

``` cd app ```

### 🔧 Installer les dépendances PHP
``` composer install ```

## Lancer un serveur de développement
Deux options s'offrent à vous pour exécuter le projet :

1️⃣ Utiliser Docker (Recommandé) – Cette méthode vous permet de bénéficier d’un environnement préconfiguré où tout est déjà prêt : base de données, serveur web, et autres dépendances essentielles.

2️⃣ Lancer Symfony directement – Si vous avez déjà une configuration locale avec PHP, une base de données et les extensions nécessaires, vous pouvez démarrer le projet sans Docker.

### 1️⃣ Lancer le serveur Docker
Assurez-vous que Docker est en cours d'exécution.

Lancez votre stack Docker :

``` docker-compose up -d ```

✅ Cela démarre tous les services (base de données, serveur web, etc.) en arrière-plan.

Vérifiez que les conteneurs sont bien en cours d'exécution :

``` docker ps ```

🎯 Si tout est correct, vous devriez voir une liste des conteneurs actifs.

### ⚠️ Arrêter le serveur Docker
Pour arrêter les conteneurs Docker, utilisez :

``` docker-compose down ```
💡 Cette commande arrête et supprime les conteneurs sans affecter les données persistantes.

Si vous voulez juste arrêter sans supprimer, utilisez :

``` docker-compose stop ```
### 2️⃣ Lancer le serveur Symfony
Pour démarrer le serveur Symfony, utilisez la commande suivante :

``` symfony server:start ```
Cela démarrera le serveur de développement. Vous pouvez accéder à l'application via votre navigateur à l'adresse http://127.0.0.1:8000 ou http://localhost:8000.

Note : Symfony vous indiquera l'adresse exacte du serveur lorsqu'il sera démarré, mais en général, il fonctionne sur 127.0.0.1 (ou localhost) sur le port 8000.

Vous pouvez arrêter le serveur avec la commande suivante :

``` symfony server:stop ```

## 🗃️ Base de données
Ce projet Symfony utilise pleinement Doctrine pour définir, gérer et modifier la structure de la base de données.
Cette approche garantit une cohérence entre les environnements de développement et de production, tout en permettant un suivi précis des évolutions du schéma de base.

### 🧩 Entités du Projet

Les entités nécessaires au bon fonctionnement de l’application ont **déjà été créées**.
Elles sont disponibles dans le répertoire suivant:

`` src/Entity/ ``

***User, Animal, Habitat, Repas, Soin***


Si vous souhaitez générer ces entités dans un autre projet Symfony, vous pouvez utiliser les commandes suivantes via Doctrine:

bash
- Créer l'entité User
``` php bin/console make:entity User ```

- Créer l'entité Animal
``` php bin/console make:entity Animal ```

- Créer l'entité Habitat
``` php bin/console make:entity Habitat ```


Chaque entité représente une structure de base de données, et Doctrine se charge de la gestion de ces objets métiers.

> 🗒️ Astuce: Après avoir créé vos entités, pensez à générer les getters/setters et éventuellement les relations entre elles selon les besoins de votre modèle.

Des données de test fictives ont été créées et sont présentes dans le dossier App.Fixtures.

### 🔄 Lancer les Fixtures (Pour le développement)
Une fois que la base de données est prête, vous pouvez charger les données de test en exécutant la commande suivante dans le terminal à partir de la racine du projet

``` php bin/console doctrine:fixtures:load ```

Cela peuplera la base de données avec les fausses données de test définies dans les fixtures. Si vous souhaitez réinitialiser la base de données avant de charger les fixtures, vous pouvez utiliser l'option --no-interaction pour éviter toute confirmation :

``` php bin/console doctrine:fixtures:load --no-interaction ```

## ⚡Exécuter les Tests
Pour exécuter tous les tests unitaires actuels, vous pouvez utiliser la commande suivante :

``` php bin/phpunit ```

