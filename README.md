# Article Hub API Endpoints

This service contains the REST APIs endpoint for Article Hub product.
In the our platform the name of the service is article-hub-api.

## Running Local Environment
1. ```git clone git@github.com:os-rescue/article-hub-api.git```
2. ```cd article-hub-api```
3. ```cp .env .env.local```
4. ```docker-compose up -d```

## Swagger
```https://article-hub:8080/api/swagger```

### Authentication API endpoint

```
Endpoint: ${HOST}/api/login_check
Method: POST
Body: {"username": "%username%", "password": "%password%"}
```
