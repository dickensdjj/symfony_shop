This project is written within 1-2 days when I was learning how to program with [Symfony](https://symfony.com/).

## Summary

In the project directory, you can run:

### `composer install`

Install Symfony App via composer install

## `yarn install`

Install Bootstrap styling and all the Javascript library

### `symfony server:start`

Runs the app in the development mode.<br />
Open [http://localhost:8000](http://localhost:8000) to view it in the browser.

### `php bin/console doctrine:database:create`

Create db via above command

### `php bin/console php bin/console make:migration`

**Note: Create migration if the project does not have files in src/Migrations**

### `php bin/console doctrine:migrations:migrate`

Actually create the db table schema via migration

## RESTful API

All APIs are defined in src/Controller/Api