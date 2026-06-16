# Garage Vincent Parrot

Application web développée avec Symfony permettant la gestion d'un garage automobile.

Le projet comprend plusieurs espaces dédiés :
- Visiteur
- Utilisateur
- Employé
- Administrateur

Il a été réalisé afin de démontrer mes compétences en développement web Full Stack avec Symfony.


## Technologies

- PHP 8
- Symfony 6
- Twig
- Doctrine ORM
- MySQL
- Bootstrap 5
- JavaScript
- AJAX
- Git / GitHub

## Fonctionnalités

### Visiteur
- Consultation des réparations
- Consultation de quelques avis
- Consultation des véhicules en vente
- Application de filtres sur les véhicules (prix, kilométrage, etc.)

### Utilisateur 
- Dispose des fonctionnalités d'un utilisateur non connecté
- Dépôt d'avis
- Formulaire de contact

### Employé
-  Consultation et recherche des comptes utilisateurs par email
- Création d'un compte d'utilisateur
- Gestion des véhicules (ajout, modification)
- Gestion des réparations (ajout, modification, suppression)


### Administrateur
- Gestion complète (CRUD) des comptes utilisateurs
- Gestion complète (CRUD) des véhicules
- Gestion complète (CRUD) des réparations
- Validation et suppression des avis utilisateurs
- Consultation et suppression des messages de contact

### Sécurité

Le projet implémente un système d'authentification et de gestion des rôles :

- ROLE_USER
- ROLE_EMPLOYE
- ROLE_ADMIN

Les accès aux différentes fonctionnalités sont restreints selon le rôle de l'utilisateur connecté.

## Profils
Voici des identifiants pour chaque rôle d'un compte utilisateur.

- Compte admin : 
avora@gmail.com
avo1234

- Compte employé : 
quentin@gmail.com
que123


- Compte utilisateur:
ABC Henri
test@gmail.com
azerty


## Installation

```bash
git clone https://github.com/Avo400/GarageVincentParrot.git
cd GarageVincentParrot
composer install