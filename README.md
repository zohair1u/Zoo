# 🦁 ZOO — Projet Symfony

Bienvenue sur **ZOO**, une application Symfony destinée à gérer les animaux, leurs habitats, les employés du parc zoologique et bien plus encore.

---

## 🚀 Installation

### Prérequis

- PHP 8.3
- Composer
- Symfony CLI (facultatif mais recommandé)
- MySQL & MongoDB
- Node.js & Yarn (si frontend intégré)

### Cloner le projet

bash
git clone https://github.com/ton-utilisateur/zoo.git
cd zoo/app
composer install


*Configuration*

Copiez le fichier `.env` ou `.env.local`:

bash
cp.env.env.local


Modifiez les variables selon votre environnement:
env
DATABASE_URL="mysql://symfony:symfony@127.0.0.1:3306/zoo_bdd"
MONGODB_URL="mongodb://127.0.0.1:27017"


*Création de la base de données*

bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load


---

*🧪 Tests*

Des tests unitaires sont disponibles avec PHPUnit:

bash
php bin/phpunit


---

*🧰 Fonctionnalités*

- 🔍 CRUD pour les animaux, les enclos, les employés
- 📦 API REST ou GraphQL (si implémentée)
- 📊 Statistiques sur le parc
- 🐒 Intégration MongoDB pour certaines données non relationnelles
- 🔐 Authentification & gestion des rôles
- 🎨 Interface web si frontend inclus

---

*🧱 Stack technique*
Symfony : Framework principal 
Doctrine ORM 
MySQL : Base de données relationnelle 
MongoDB : Base NoSQL 
PHPUnit : Tests 
Composer : Gestion des dépendances
GitHub Actions : CI/CD

*📂 Structure du projet*


app/
├── config/
├── src/
│   ├── Controller/
│   ├── Entity/
│   ├── Repository/
├── templates/
├── tests/
└── public/


---

*🙌 Contribuer*

Les contributions sont les bienvenues! Pour proposer une amélioration:

1. Forkez ce repo
2. Créez une branche `feature/nom-de-votre-fonction`
3. Envoyez une pull request 🎉

---

*📄 Licence*

Ce projet est sous licence [MIT](LICENSE).

---

*📫 Contact*

Tu peux me joindre à l’adresse: zouhir.piniz@gmail.com
Ou créer une issue directement sur GitHub.

---

> Développé avec ❤️ en Symfony par un passionné des animaux.
