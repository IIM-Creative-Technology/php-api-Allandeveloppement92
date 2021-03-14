# Php-api par Allan GERME - A3 Alternant
  
  Voici deux projets : api_devinci en SYMFONY et api_plateform_devinci en API PLATFORM. 
  Ces deux API servent à refaire l'interface d'attribution des notes des étudiants de l'IIM. 
  
## Api_devinci 

### Initialisation du projet

Installation des packages, liasion à la BDD et load des fixtures : 

  composer install
  php bin/console doctrine:database:create
  php bin/console doctrine:migrations:diff
  php bin/console doctrine:migrations:migrate
  php bin/console make:fixtures:load
  
### Lancement du projet

  symfony server:start 

### Utilisation de Postman 

  Les différentes routes sont : 
    
    /etudiants
    /promotions
    /intervenants 
    /matieres
    /notes
    
  Existence d'un CRUD composé des méthodes : 
  
    GET
    POST 
    PUT
    DELETE
    
  En se référant à la base de donnée, possibilité de récupérer les "id" à l'intérieur des différentes tables. 
  
