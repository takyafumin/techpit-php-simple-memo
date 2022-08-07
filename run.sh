#!/usr/bin/env bash

if [ $# -eq 0 ]; then
    docker-compose -f .docker_memo/docker-compose.yml ps

elif [ "$1" == "ps" ]; then
    docker-compose -f .docker_memo/docker-compose.yml ps

elif [ "$1" == "up" ]; then
    docker-compose -f .docker_memo/docker-compose.yml up -d

elif [ "$1" == "down" ]; then
    shift 1;
    docker-compose -f .docker_memo/docker-compose.yml down $@

elif [ "$1" == "destroy" ]; then
    docker-compose -f .docker_memo/docker-compose.yml down -v --remove-orphense

elif [ "$1" == "ci" ]; then
    cd .docker_memo/
    docker-compose exec php ./vendor/bin/phpcbf
    docker-compose exec php ./vendor/bin/phpcs
    # docker-compose exec php ./vendor/bin/phpmd . text ruleset.xml

fi
