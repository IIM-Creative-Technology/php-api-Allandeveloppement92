# Php-api par Allan GERME - A3 Alternant
  
  Voici deux projets : api_devinci en SYMFONY et api_plateform_devinci en API PLATFORM. 
  Ces deux API servent à refaire l'interface d'attribution des notes des étudiants de l'IIM. 
  
## Api_devinci 

### Initialisation du projet

Installation des packages, liaison à la BDD + migrations et load des fixtures : 

  - composer install
  - php bin/console doctrine:database:create
  - php bin/console doctrine:migrations:diff
  - php bin/console doctrine:migrations:migrate
  - php bin/console doctrine:fixtures:load
  
### Lancement du projet

  symfony server:start 
 
### Les requêtes possibles 

  Sur Postman il est possible de réaliser des requêtes sur l'API. 
  
#### Etudiant

    GET    -> http://127.0.0.1:8000/etudiants 
    GET    -> http://127.0.0.1:8000/etudiants/{id}
    POST   -> http://127.0.0.1:8000/etudiants
    PUT    -> http://127.0.0.1:8000/etudiants/{id}
    DELETE -> http://127.0.0.1:8000/etudiants/{id}
    
 #### Promotion

    GET    -> http://127.0.0.1:8000/promotions
    GET    -> http://127.0.0.1:8000/promotions/{id}
    POST   -> http://127.0.0.1:8000/promotions
    PUT    -> http://127.0.0.1:8000/promotions/{id}
    DELETE -> http://127.0.0.1:8000/promotions/{id}
    
  #### Intervenant

    GET    -> http://127.0.0.1:8000/intervenants
    GET    -> http://127.0.0.1:8000/intervenants/{id}
    POST   -> http://127.0.0.1:8000/intervenants
    PUT    -> http://127.0.0.1:8000/intervenants/{id}
    DELETE -> http://127.0.0.1:8000/intervenants/{id}
  
  #### Matière

    GET    -> http://127.0.0.1:8000/matieres
    GET    -> http://127.0.0.1:8000/matieres/{id}
    POST   -> http://127.0.0.1:8000/matieres
    PUT    -> http://127.0.0.1:8000/matieres/{id}
    DELETE -> http://127.0.0.1:8000/matieres/{id}
    
 ### Authentification
 
  Sur cette API, l'authentification ce fait par API Key. 
  Il faut donc : 
  - Récupérer l'API Key d'un utilisateur sur la table "User"; 
  - Retourner sur Postman et sélectionner l'onglet "Authorization";
  - Sélectionner "API Key" dans la liste déroulante "Type"; 
  - Insérer l'API Key dans le champs "Value"; 

Il est à noté que l'installation d'une authentification par JWT est configurée sur le projet via "LexikJWTAuthenticationBundle", mais n'est pas fonctionnelle.  

## Api_devinci_plateform

### Initialisation du projet

Installation des packages et d'API Platform, liaison à la BDD + migrations et load des fixtures : 

  - composer install
  - composer require api (installe le pack API)
  - php bin/console doctrine:database:create
  - php bin/console doctrine:migrations:diff
  - php bin/console doctrine:migrations:migrate
  - php bin/console doctrine:fixtures:load
  
### Lancement du projet

  symfony server:start 
 
### Les requêtes possibles 

  Sur Postman et sur API platform, il est possible de réaliser des requêtes sur l'API. 
  Puur accèder à API Platform, dans le navigateur, il faut taper la route : http://127.0.0.1:8000/api (ou http://127.0.0.1:8000/api/docs).
  
#### Etudiant

    GET    -> http://127.0.0.1:8000/etudiants
    GET    -> http://127.0.0.1:8000/etudiants/{id}
    POST   -> http://127.0.0.1:8000/etudiants
    PUT    -> http://127.0.0.1:8000/etudiants/{id}
    DELETE -> http://127.0.0.1:8000/etudiants/{id}
    
 #### Promotion

    GET    -> http://127.0.0.1:8000/promotions
    GET    -> http://127.0.0.1:8000/promotions/{id}
    POST   -> http://127.0.0.1:8000/promotions
    PUT    -> http://127.0.0.1:8000/promotions/{id}
    DELETE -> http://127.0.0.1:8000/promotions/{id}
    
  #### Intervenant

    GET    -> http://127.0.0.1:8000/intervenants
    GET    -> http://127.0.0.1:8000/intervenants/{id}
    POST   -> http://127.0.0.1:8000/intervenants
    PUT    -> http://127.0.0.1:8000/intervenants/{id}
    DELETE -> http://127.0.0.1:8000/interenants/{id}
  
  #### Matière

    GET    -> http://127.0.0.1:8000/matieres
    GET    -> http://127.0.0.1:8000/matieres/{id}
    POST   -> http://127.0.0.1:8000/matieres
    PUT    -> http://127.0.0.1:8000/matieres/{id}
    DELETE -> http://127.0.0.1:8000/matieres/{id}
    
 ### Authentification
 
  Sur cette API, l'authentification ce fait par JWT (Token). 
  Il faut donc : 
  - A partir de Postman, sur la route "/login", faire une méthode POST pour se connecter, en insérant son "username" (email) et son "password" (password); 
  - Récupérer le token généré lors de l'authentification. 
  - Retourner sur API Platform et sélectionner l'onglet "Authorize" (en haut à gauche de la page);
  - Insérer, dans le champs "Type", "Bearer 'token généré'"; 

N'oubliez pas de créer votre dossier config/jwt, générer des clés privée et publique via openSSL et insérer votre passphrase dans le ".env". 
