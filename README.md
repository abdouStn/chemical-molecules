# Symfony 3 - Site web référençant les molécules et leur composition (atomes)

Projet Symfony créé avec les gestionnaires de dépendances :

* Composer
* Bower

Avant de lancer les commandes, assurez-vous :

* d'avoir configuré app/config/parameters.yml
* d'avoir créé la base de données

A la racine du projet, pour installer les vendors depuis un terminal, lancer :
```
#!sh

bower install
composer install
cd src/ChemicalsBundle
bower install
```

Revenir à la racine du projet; installer le schéma relationnel
```
#!sh

bin/console doctrine:schema:update --force
```


Installer les assets des bundles inclus :
```
#!sh

bin/console assets:install
```

Installer les données de test
```
#!sh

bin/console doctrine:fixtures:load
bin/console fos:user:create admin admin@test.test passwd --super-admin
```

Pour tester rapidement, à la racine du projet :
```
#!sh

bin/console server:run
```

Pour lancer les tests unitaires automatisés et le code coverage, à la racine du projet :
```
#!sh

phpunit
```

A noter que pour fonctionner, il est nécessaire d'installer PHPUNIT, d'avoir PHP5.6+ et xDebug d'activé.

TODO :

* Finir d'implémenter les form collections (édition des groupes d'atomes).
* Problème de token CSRF (form groupes d'atomes)
* Améliorer l'UX et la navigation admin
* Fil d'Ariane pour édition/ajout des groupes d'atomes

Contient des exemples :

* Routing
* MVC (model sans injection de dépendances)
* Fil d'Ariane
* Templating Twig avec décomposition de templates
* Intégration de Bootstrap
* Gestion des inclusions de fichiers
* Données d'exemple via Fixture
* Intégration de FOS/UserBundle
* Interfaçage avec bibliothèques javascript visjs & chart.js
* Utilisation et déclaration de services

## Superviseur
Aurélien Muller (aurelien.muller@cgi.com)

## Auteur
Abdoulaye DIALLO

## Date
Decembre 2016
