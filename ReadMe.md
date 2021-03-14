# Documentation de l'API

Cette API a été réalisée grâce à Symfony et API Plateform ainsi que le système de token JWT

## Prérequis

-POSTMAN

-Composer

## Lancer le projet

Afin de pouvoir lancer le projet, lancer dans un premier temps la commande 

-composer install

-php bin/console doctrine:fixtures:load

Après avoir lancer le projet, vous devez aller sur la route /api

Cependant, vous ne pourrez pas faire de requêtes tant que vous ne n'aurez pas de token utilisateur.

C'est donc maintenant que vous aurez besoin de Postman:

En POST à l'url : /api/login
Dans le BODY en raw et en JSON

Rentrer les lignes suivantes:

{
  "email":"Nicolas@edu.devinci.fr",
  "password":"password"
 }
 
 Cela va vous donner un token, copiez le.
 
 Dans votre navigateur, dans la section authorize,
 Rentrer "Bearer" + le token copié.
 
 Vous pouvez maintenant faire vos requêtes.
 
 
 ## Requêtes
 
 Nous avons 5 classes, 10 étudiants, 10 intervenants, 5 matières ainsi que 5 notes.
 
 Vous pouvez donc faire les requêtes classiques au CRUD.
 Cependant, je conseille de commencer par des POSTS pour tester les requêtes.
 
 Classe : {nomPromo,anneeSortie}
 
 Etudiant : {nom,prenom,age,anneeArrivee,classe_id}
 
 Intervenant: {nom,prenom,anneeArrivee}
 
 Matiere: {nom,dateDebut,dateFin,intervenant_id,classe_id}
 
 Note: {note,etudiant_id,matiere_id}



