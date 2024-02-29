# devis_codeigniter

## Description

devis_codeigniter est un projet de développement d'une application web de gestion de devis pour une entreprise de services informatiques. Il est basé sur le framework CodeIgniter 4.

## Fonctionnalités

- Gestion des utilisateurs
- Gestion des clients
- Gestion des devis
- Gestion des prestations
- Gestion des tarifs

## Installation

- Installer composer
- Installer PHP ( deja installé via MAMP)
- Installer les dépendances avec Composer
- Creer un dossier CodeIgniter4
- Configurer le fichier `.env` pour la base de données
- Creer les modèles Items, Devis, DevisItems, Users, Clients .
- Créer la base de données avec les migrations + les seeds et verifier que les tables sont bien créées via phpMyAdmin
- Lancer le serveur web (MAMP)
- Se connecter à l'application avec un navigateur
- Creer les contrôleurs  et les vues pour les items de la base de données
- Creer les controlleurs et les vues pour les devis
- Créer les contrôleurs et les vues pour les utilisateurs
- Créer un système de gestion des utilisateurs incluant la connexion, la déconnexion, l'authentification, les autorisations et les permissions.
- Creation du style de l'application avec Bootstrap

## Configuration

- Copie de `env` en `.env` et adaption à l'application, en particulier l'URL de base et tous les paramètres de la base de données.
- Mise en place du mode de développement 

## Défis rencontrés et solutions

- Défi : Création de la base de données avec les migrations et les seeds
  Solution : Utilisation des migrations et des seeds pour créer la base de données et les données de test.

- Défi : Création du système de gestion des utilisateurs
  Solution que j'aurais du utiliser : Utilisation de la bibliothèque IonAuth pour gérer les utilisateurs, les rôles et les permissions.

- Défi : Création des contrôleurs et des vues pour les utilisateurs
    Solution : Utilisation des contrôleurs et des vues pour afficher les utilisateurs de la base de données.
- Défi : Création des contrôleurs et des vues pour les items de la base de données
    Solution : Utilisation des contrôleurs et des vues pour afficher les items de la base de données.
- Défi : Création des contrôleurs et des vues pour les devis
    Solution : Utilisation des contrôleurs et des vues pour afficher les devis de la base de données.

- Défi : Création du système de gestion des clients
    Solution : Utilisation des contrôleurs et des vues pour afficher les clients de la base de données.
- Défi : Création du système de gestion des prestations
    Solution : Utilisation des contrôleurs et des vues pour afficher les prestations de la base de données.
- Défi : Création du système de gestion des tarifs
    Solution : Utilisation des contrôleurs et des vues pour afficher les tarifs de la base de données.

- Défi : Création du style de l'application avec Bootstrap
    Solution : Utilisation de Bootstrap pour le style de l'application.

## Décisions de conception importantes

- Pas d'ajout de validations des données en plus que ce que fait déjà CodeIgniter 4 car c'est un projet de démonstration
- Utilisation de Bootstrap pour le style de l'application car c'est un framework CSS populaire et facile à utiliser
- Utilisation des migrations et des seeds pour créer la base de données et les données de test car c'est une méthode de développement efficace
- Utilisation des contrôleurs et des vues pour afficher les utilisateurs, les items, les devis, les clients, les prestations et les tarifs de la base de données car c'est une méthode de développement efficace
- Utilisation de la bibliothèque IonAuth pour gérer les utilisateurs, les rôles et les permissions ( j'aurais du mais je suis passée a côté) car c'est une bibliothèque populaire et facile à utiliser
- Utilisation des contrôleurs et des vues pour afficher les utilisateurs de la base de données car c'est une méthode de développement efficace

## Tests

Je n'ai pas eu le temps de faire des tests unitaires et fonctionnels pour ce projet.
Mais CodeIgniter 4 est livré avec un ensemble de tests unitaires et fonctionnels que je pourrais utiliser pour tester mon application.

## Améliorations futures

(les améliorations qui pourraient être d'apportées à l'application à l'avenir seraient les suivantes, en restnt de le cadre d'un projet de démonstration) :

Coté sécurité :

- Ajout de validations des données en plus que ce que fait déjà CodeIgniter 4
- Ajout de la bibliothèque IonAuth pour gérer les utilisateurs, les rôles et les permissions
- Ajout de tests unitaires et fonctionnels pour l'application
- Ajout de la protection contre les attaques par injection SQL
- Ajout de la protection contre les attaques par usurpation de session
- Ajout de la protection contre les attaques par divulgation d'informations
- Ajout de la protection contre les attaques par validation de formulaire

Coté fonctionnalités :

- Ajout de la gestion des clients
- Ajout de la gestion des utilisateurs
- Ajout de la gestion des prestations
- Ajout de la gestion des tarifs
- Ajout de la gestion des factures
- Ajout de la gestion des paiements

Coté proprete et efficacité du code :

- Ajout de services pour la logique métier
    Utilisez des services pour la logique métier : Vous pouvez déplacer la logique métier de votre contrôleur vers des services. Cela rendra votre contrôleur plus propre et plus facile à maintenir.

- Ajout de modèles pour les requêtes de base de données
    Utilisez des modèles pour les requêtes de base de données : Vous pouvez déplacer les requêtes de base de données de votre contrôleur vers des modèles. Cela rendra votre contrôleur plus propre et plus facile à maintenir.

- Utilisation de transactions pour les opérations de base de données
    Utilisez des transactions pour les opérations de base de données : Vous pouvez utiliser des transactions pour vous assurer que plusieurs opérations de base de données sont exécutées avec succès ou annulées si l'une d'entre elles échoue.

- Utilisation de messages flash pour les notifications
    Utilisez des messages flash pour les notifications : Au lieu de lancer des exceptions lorsque vous ne recevez pas de données de la requête POST, vous pouvez utiliser des messages flash pour informer l'utilisateur que quelque chose s'est mal passé.

- Utilisation de validations de formulaire
    Utilisez des validations de formulaire : Vous pouvez utiliser des validations de formulaire pour vous assurer que les données reçues de la requête POST sont valides avant de les utiliser.

- Utilisation de vues partielles
    Utilisez des vues partielles : Pour rendre votre code de vue plus propre et plus facile à maintenir, vous pouvez utiliser des vues partielles. Par exemple, vous pouvez avoir une vue partielle pour le formulaire d'ajout d'item, une autre pour la liste des items, etc.

- Utilisation de helpers pour le formatage des données
    Utilisez des helpers pour le formatage des données : Au lieu de formater les données directement dans votre vue, vous pouvez utiliser des helpers. Par exemple, vous pouvez avoir un helper pour formater les dates, un autre pour formater les prix, etc.

- Utilisation d'événements pour les actions qui ne sont pas directement liées à la requête actuelle
    Utilisez des événements pour les actions qui ne sont pas directement liées à la requête actuelle : Par exemple, vous pouvez déclencher un événement lorsque vous ajoutez un nouvel item à un devis, et avoir un écouteur d'événements qui met à jour le total du devis.

- Utilisation de méthodes de modèle  mieux organisées pour les requêtes de base de données
    Utilisez des méthodes de modèle pour les requêtes de base de données : Au lieu d'écrire des requêtes de base de données directement dans votre contrôleur, vous pouvez utiliser des méthodes de modèle. Cela rendra votre contrôleur plus propre et plus facile à maintenir.

- Utilisation de noms de variables significatifs
    Utilisez des noms de variables significatifs : Cela rendra votre code plus facile à lire et à comprendre.

Coté performances :

- Utilisation de la mise en cache pour les données qui ne changent pas souvent
- Utilisation de la pagination pour les listes de données
- Utilisation de la compression pour les fichiers statiques
- Utilisation de la mise en cache pour les requêtes de base de données
- Utilisation de la mise en cache pour les vues

Coté style :

- Ajout de styles personnalisés pour l'application
- Ajout de thèmes pour l'application
- Ajout de la prise en charge des mobiles

Coté accessibilité :

- Ajout de la prise en charge des lecteurs d'écran
- Ajout de la prise en charge des claviers

Coté documentation :

- Ajout de la documentation de l'API
- Ajout de la documentation de l'application

Coté tests :

- Ajout de tests unitaires pour l'application
- Ajout de tests fonctionnels pour l'application
- Ajout de tests de performance pour l'application
- Ajout de tests de sécurité pour l'application




CREATE TABLE `users` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT,
    `user_name` VARCHAR(20),
    `role` VARCHAR(255) DEFAULT NULL,
    `n_siret` VARCHAR(255),
    `adresse_entrprise` TEXT,
    `tel` VARCHAR(20),
    `is_admin` BOOLEAN DEFAULT false,
    `email` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    `created_at` DATETIME DEFAULT NULL,
    `updated_at` DATETIME DEFAULT NULL,
    `deleted_at` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
);


CREATE TABLE 'items' (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255),
    price DECIMAL(10, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL
);

CREATE TABLE devis (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT(11) UNSIGNED NOT NULL,
    total_devis DECIMAL(10,2) DEFAULT '0.00',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE devis_items (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    devis_id INT(11) UNSIGNED NOT NULL,
    item_id INT(11) UNSIGNED NOT NULL,
    quantity INT(11) NOT NULL,
    custom_price DECIMAL(10,2) DEFAULT '0.00',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    deleted_at TIMESTAMP NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (devis_id) REFERENCES devis(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE ON UPDATE CASCADE
);
