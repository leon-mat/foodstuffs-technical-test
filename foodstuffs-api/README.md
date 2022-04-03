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

# doctrine migrations
After starting the database, you can update your schemas with
```
make migrate-test && make migrate
```