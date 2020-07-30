## Docker Develop Environment
[Detail Document](Docker.md)

## Quick Start
```$xslt
$ cp .env.example .env //then mofidy your .env

$ composer install --ignore-platform-reqs

$ docker-composer up -d 

$ docker exec -it unit.test bash

$ cd /www/unit.test

$ vendor/bin/phpunit --configuration phpunit.xml --colors  tests
```