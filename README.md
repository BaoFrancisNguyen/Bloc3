# Bloc 3

## Project structure

- a PHP application
- a dockerized MariaDB database
- a Python script to populate the database (cf `data` folder)

## Pre requisites

- standard Docker Desktop installation

## How to setup

- Clone the repository
- `docker-compose up -d`
- go to http://localhost
- if you want to take a look at the database, go to http://localhost:8080 (phpMyAdmin)

warning: if the database seeder doesn't do his job, just copy/paste `data\schema.sql`on the phpmyadmin (user=bloc3 --password=bloc3 --host=database)