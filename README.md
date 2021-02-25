# Résumé rapide du test technique

J'ai effectué ce test sur 3 demi-journées (2 pour le backoffice, 1 pour le frontoffice)

Voici les grandes lignes :

Récupération et mise en place de la DB

Installation du projet Symfony intitulé Pandacraft

Rensignement du .env pour accéder à la DB

Génération des entités en fonction des données de la DB (avec le reverse engineering de Symfony)

Génération des getters/setters des entités

Création des repository à partir des entités

Ajout de Doctrine, Serializer, Twig, Form, MakerBundle, Validator

Création du premier controller, HomeController pour la page d'accueil

Je fais le choix de partir sur les produits, donc affichage, ajout, suppression, modification d'un produit par un membre du magasin.

Création de la page d'affichage de tous les produits. Avec utilisation des groupes pour eviter les références circulaires.

Création de la page d'ajout de produit.

Création du formulaire d'ajout de produit.

Création de la page d'affichage d'un seul produit.

Ajout de la suppression de l'élément sur la page produit.

Ajout de la modification de l'élément sur la page produit.

Création du formulaire de modification du produit.

Habillage et intéractions afin de rendre le tout plus convivial :
* Popup pour signifier si une action c'est bien déroulée (ajout, suppresion, modification)
* Mise à jour des informations directement (lorsqu'on modifie un produit par exemple)
* Thème maquette de voiture