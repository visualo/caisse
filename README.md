<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About CAISSE

Une application pour les opérations sur une caisse de jour qui enregistre des encaissements en billets, pièces et centimes et en fait le récapitulatif.

- Page de saisie.
- Page dashboard.
- Page types d'opération.

## Installation 

- Après télécharger ou bien cloner le projet taper la commande : composer update
- Créer le nom de la base de données dans le fichier .env
- Taper la commande : npm install pour automatiser l'installation des dépendances
- Taper la commande : npm run dev pour compiler tous les assets including la source map


## Database

- Taper la commande : php artisan make:migration pour la migration de la base de données
- Taper la commande : php artisan db:seed pour initialiser votre base de données avec des faker data


## Execution

- Taper la commande : php artisan serve pour lancer l'application

