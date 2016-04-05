# SFLive Paris 2016 REST Workshop

## Install the application

Install the dependencies:
    $ composer install

Configure the database settings in your `app/config/parameters.yml`.

    parameters:
        database_driver: pdo_mysql
        database_host: localhost
        database_port: null
        database_name: sf2c15_rest
        database_user: root
        database_password: ~
        locale: en
        secret: ThisTokenIsNeitherSecretButNeededForInsight

Build the dabatase and schema.

    $ cd /path/to/smoovio
    $ php bin/console doctrine:database:create
    $ php bin/console doctrine:schema:create

Load the data.

    $ mysql -u [user] -p [password] sflive_paris_2016_rest_workshop < data.sql

Build the featured movies list.

    $ php bin/console smoovio:playlist:create_featured

Run PHP built-in web server.

    $ php bin/console server:run

Launch the application in your web browser.

    http://localhost:8000/app_dev.php

Wow effect!!!

