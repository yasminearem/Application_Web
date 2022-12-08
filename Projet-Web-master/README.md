
# Projet-Web

Projet d'application web pour un site transactionnel de vente en ligne (projet tuteuré IUT)


## Installation (pour les administrateurs)

Cette partie s'adresse aux administrateurs Web qui souhaitent istaller le site des Chatons sur leur serveur.

### Configuration requise

+ Debian server
+ Apache2 / PHP / SQLite3
+ Connexion Internet fonctionnelle

### Procédure d'installation

Afin d'installer le site des Chatons, vous devz suivre les instrutions suivantes : 

+ cloner le dépot git : ``` git clone https://github.com/aircstnr/Projet-Web.git ``` 
+ se placer dans le dosier principal : ``` cd Projet-Web ```
+ exécuter le script de droits : ``` ./setup-chatons.sh ```

## Informations techniques

### MVC

Le projet est sous forme de MVC.


Le ** Modèle ** est composé de plusieurs fichiers en PHP uniquement, en particulier :

+ *classes.php* contient les classes des objets PHP
+ *DAO.php* contient les méthodes d'accès à la base de données des différents objets du site
+ *test.php* contient un jeu de tests unitaires pour valider la pertinence de la DAO
+ *create_base.sql* et *remplir_base.sql* servent à créer les éléments de la base de données et à la remplir avec des infos de base
+ *data/base.db* contient la base de données du site

*** Shéma Relationnel ***

~~~c
Utilisateur (nom, prénom, mail, mdp); // attention, le mot de passe est stocké en clair, l'identifiant d'un utilisateur est son adresse mail
Produit (titre, référence, complément, prix, photo); // la photo est un string qui indique le nom du fichier dans Projet-Web/data
Catégorie (nom); // une catégorie est uniquement son propore nom
AppartieÀ (référence, nom); // un produit appartient à une seule et unique catégorie
Ligne_Panier (mail, référence, date, quantité, validé); // une ligne de panier associe un utilisateur et un produit pour une date donnée et a une quantité et une valeur (true pour indiquer que c'est acheté
~~~

La ** Vue ** est composée de chaque page en PHP/HTML associée à sa feuille de style CSS

Le ** Contrôleur ** est composé de fichiers PHP :

+ *index.php* est le point d'entrée du site, il gère les appels des pages, et l'autentification de l'utilisateur
+ *verifIdent.php* contrôle l'identité donnée par l'utilisateur sur la page *Projet-Web/vue/connextion.php*
+ d'autres scripts PHP permettent le dynamisme du site


### Administration

Les administrateurs peuvent librement adapter le site grâce aux indications présentes dans le code et grâce aux pages d'accès aux informations utiles :

+ L'administrateur `admin`/`admin` peut se connecter comme tout utilisateur
+ Il peut modifier les utilisateurs avec la page adéquate ou en inscrire des nouveaux (tout bêtement par la page d'inscription)
+ Il peut modifier des produits et en ajouter avec un frmulaire adapté


### Documentation

Voir le dossier Google Drive partagé pour trouver les infos d'aide pour SQLite.

Contacter les auteurs pour plus de détails.

## Manuel d'utilisation (pour les usagers du site)

Le site les chatons vous permet de consulter les chatons disponibles à l'achat sur notre site.

Vous pouvez regarder la liste des chatons par catégories en cliquant sur une catégorie `Mignons`, `Jolis` ...

Vous pouvez vous inscrire/connecter via le bouton `Mon compte`.

Consultez votre panier avec le bouton `Panier`.

Commandez le contenu de votre panier en cliquant sur `Commander`.

Déconnectez vous en cliquant sur le bouton `Déconnexion` en haut à droite de chaque page du site quand vous êtes connecté.



## Auteurs du site

+ Brenda Hoareau
+ Alexandre Garenza
+ Julien Viala
+ Raphaël Castanier


## Remerciements

Le groupe de travail souhaite remercier les tuteurs Christophe Brouard et Jean-Pierre Chevallet.

