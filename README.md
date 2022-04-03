# foodstuffs-technical-test
An api to manage foodstuffs (it's an technical exercise)

# Start
First launch the server or tests, you must install dependencies of the project with the command :
```
make install
```

You can start tests with the command :
```
make tests
```

You can run the web server with the command : 
```
m̀ake serve
```
to access to api on your http://localhost url (if you already have a started web serve, change the "nginx" port in the [infra/docker-compose.yml](https://github.com/leon-mat/foodstuffs-technical-test/blob/main/foodstuffs-api/infra/docker-compose.yml) file)

# Documentation
- Read first the pdf of the excecise: [Test technique back sénior](https://github.com/leon-mat/foodstuffs-technical-test/blob/main/Test%20technique%20back%20s%C3%A9nior.pdf)
- See the openfoodfact api documentation : https://openfoodfacts.github.io/api-documentation/ (principally chapters 3 and 5)

# Backlog / todo
- create route /save/substitution/ean_du_produit
- create route /clear
- add pagination to route /search/name
- add field 'best_substitution' to foodstuff in the api response
- JWT authentication (and use it to wishlist and exclusions)
- document the api responses
- format of responses api follow json:api specs (https://jsonapi.org/examples/)
- add an index and links to navigate in the api
- custom 404