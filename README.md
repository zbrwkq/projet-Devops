# projet-Devops


## Routes api :


### Catégorie
 - /category méthode GET : retourne la liste des catégories
 - /category méthode POST : Créé une nouvelle catégorie
 - /category/id méthode GET : retourne les détail de la catégorie correspondant à l'id
 - /category/id méthode PUT : Met à jour la catégorie correspondant à l'id
 - /category/id méthode DELETE : Supprime la catégorie correspondant à l'id
 
 ### Structure des catégories
 ```
 {
  title: [titre]
 }
 ```


### Article
 - /post méthode GET : retourne la liste des articles
 - /post méthode POST : Créé un nouvel article
 - /post/id méthode GET : retourne les détail de l'article correspondant à l'id
 - /post/id méthode PUT : Met à jour l'article correspondant à l'id
 - /post/id méthode DELETE : Supprime l'article correspondant à l'id
 
  ### Structure des articles
 ```
 {
  title: [titre]
  content: [contenu]
  category: [id de la catégorie]
 }
 ```

 ### Docker 
 
 1 - Démarrer le Docker : docker-compose up -d

 2 - Accéder à l'image PHP : docker exec -it php sh
 
 3 - Exécuter la commande "doctrine:migrations:migrate" : php bin/console doctrine:migrations:migrate --no-interaction

 4 - Vous pouvez tester l'API en utilisant Postman ou cURL pour envoyer des requêtes HTTP et vérifier les réponses en accédant à localhost sur le port 8000
 