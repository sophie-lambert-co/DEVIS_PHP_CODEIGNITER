# Application de gestion de devis avec CodeIgniter 4

## À propos de l'application de gestion de devis

Cette application est un système de gestion de devis pour une entreprise de services informatiques. Elle permet de gérer les utilisateurs, les clients, les devis, les prestations et les tarifs. L'application est construite avec le framework PHP CodeIgniter 4 et utilise Bootstrap pour le style

## Installation & mises à jour de l'application de gestion de devis

- Installer composer
- Installer PHP
- Installer les dépendances avec Composer
- Créer un dossier CodeIgniter4
- Configurer le fichier `.env` pour la base de données

## Configuration de l'application de gestion de devis

Copiez `env` en `.env` et adaptez-le à votre application, en particulier l'URL de base et tous les paramètres de la base de données.

## Utilisation de l'application de gestion de devis

Après avoir installé et configuré l'application, vous pouvez la lancer en utilisant le serveur web de votre choix (par exemple, MAMP). Ensuite, vous pouvez accéder à l'application via votre navigateur.

## Licence

Informations sur la licence du projet.

## Démarrage d'application CodeIgniter 4

### Qu'est-ce que CodeIgniter ?

CodeIgniter est un framework web full-stack PHP qui est léger, rapide, flexible et sécurisé.
Plus d'informations peuvent être trouvées sur le [site officiel](https://codeigniter.com).

Ce dépôt contient un starter d'application installable via composer.
Il a été construit à partir du
[dépôt de développement](https://github.com/codeigniter4/CodeIgniter4).

Plus d'informations sur les plans pour la version 4 peuvent être trouvées dans [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) sur les forums.

Le guide utilisateur correspondant à la dernière version du framework peut être trouvé
[ici](https://codeigniter4.github.io/userguide/).

### Installation & mises à jour

`composer create-project codeigniter4/appstarter` puis `composer update` à chaque fois
qu'il y a une nouvelle version du framework.

Lors de la mise à jour, vérifiez les notes de version pour voir s'il y a des changements que vous pourriez devoir appliquer
à votre dossier `app`. Les fichiers affectés peuvent être copiés ou fusionnés à partir de
`vendor/codeigniter4/framework/app`.

### Configuration

Copiez `env` en `.env` et adaptez-le à votre application, en particulier l'URL de base
et tous les paramètres de la base de données.

### Changement important avec index.php

`index.php` n'est plus à la racine du projet ! Il a été déplacé à l'intérieur du dossier *public*,
pour une meilleure sécurité et une séparation des composants.

Cela signifie que vous devriez configurer votre serveur web pour "pointer" vers le dossier *public* de votre projet, et
non vers la racine du projet. Une meilleure pratique serait de configurer un hôte virtuel pour pointer là. Une mauvaise pratique serait de pointer votre serveur web vers la racine du projet et de s'attendre à entrer *public/...*, car le reste de votre logique et le
framework sont exposés.

**S'il vous plaît** lisez le guide utilisateur pour une meilleure explication de comment CI4 fonctionne !

### Gestion du dépôt

Nous utilisons les problèmes GitHub, dans notre dépôt principal, pour suivre les **BUGS** et pour suivre les paquets de travail de **DÉVELOPPEMENT** approuvés.
Nous utilisons notre [forum](http://forum.codeigniter.com) pour fournir du SUPPORT et pour discuter
des DEMANDES DE FONCTIONNALITÉS.

Ce dépôt est un dépôt de "distribution", construit par notre script de préparation de release.
Les problèmes avec celui-ci peuvent être soulevés sur notre forum, ou en tant que problèmes dans le dépôt principal.

### Exigences du serveur

La version PHP 7.4 ou supérieure est requise, avec les extensions suivantes installées :

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> **Avertissement**
> La date de fin de vie de PHP 7.4 était le 28 novembre 2022. Si vous utilisez
> encore PHP 7.4, vous devriez mettre à jour immédiatement. La date de fin de vie
> pour PHP 8.0 sera le 26 novembre 2023.

De plus, assurez-vous que les extensions suivantes sont activées dans votre PHP :

- json (activé par défaut - ne le désactivez pas)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) si vous prévoyez d'utiliser MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) si vous prévoyez d'utiliser la bibliothèque HTTP\CURLRequest library


