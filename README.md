# handling-csv-data-in-php

Handling CSV data in php using the league/csv package.

## Installation

Install and configure [Docker](https://docs.docker.com/engine/install/) and [Docker Compose](https://docs.docker.com/compose/install/).

## Run the program

Run the docker containers:

```bash
docker-compose up -d
```

Open in your browser the url: <http://127.0.0.1:8080>.

## Run the unit tests

```bash
docker-compose up -d # If it has not been started before
docker-compose exec php php vendor/bin/phpunit
```
