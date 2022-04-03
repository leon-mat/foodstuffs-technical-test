# foodstuffs-technical-test
An api to manage foodstuffs (it's an technical exercise)

# Documentation
- Read first the pdf of the excecise: [Test technique back sénior](https://github.com/leon-mat/foodstuffs-technical-test/blob/main/Test%20technique%20back%20s%C3%A9nior.pdf)
- See the openfoodfact api documentation : https://openfoodfacts.github.io/api-documentation/ (principally chapters 3 and 5)

# Backlog / todo
- add madiaDB to infra
- create route /save/ean_du_produit
- create route /save/substitution/ean_du_produit
- create route /exclude/ean_du_produit
- create route /delete/ean_du_produit
- create route /clear
- add pagination to route /search/name
- JWT authentication
- format of responses api follow json:api specs (https://jsonapi.org/examples/)
- add an index and links to navigate in the api
- custom 404