# Installation

[Back to summary](index.md)

## Download the project

Consider reading the [contribution guide](/CONTRIBUTING.md).

```bash
cd your path (example : C:/wamp64/www)
git clone https://github.com/cdiot/ryokosan.git
```

## Prerequisites

- PHP 8.1
- Composer
- MySQL 8.0
- Symfony CLI
- Nodejs et npm

You can check the prerequisites with the following command (from the Symfony CLI) :

```bash
symfony check:requirements
```

## Install dependencies

To install dependencies typed the following commands :

```bash
composer install
npm ci (install all exact version dependencies from a package-lock)
npm run build
```

## Environnements

To make the project work on your machine, remember to configure the different environment. A documentation on this subject is present [here](2_environnements.md).

## Initialize the databases

To create the database in development environment typed the following commands :

```bash
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate
```

Tests that interact with the database use their own separate database to not mess with the databases used.

To do that, create the test database and all tables using :

```bash
symfony console --env=test doctrine:database:create
symfony console --env=test doctrine:migrations:migrate
```

## Run datafixtures

To run datafixtures typed the following commands :

```bash
symfony console doctrine:fixtures:load
```

## Run the server locally

Run the following command :

```bash
symfony serve -d
```
