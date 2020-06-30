#!/usr/bin/env bash

function start() {
    docker-compose up -d
}

function stop() {
    docker-compose stop
}

function php() {
    docker exec -it simple_mvc_php /bin/bash
}

function server() {
    docker exec -it simple_mvc_web /bin/bash
}

function db() {
    docker exec -it simple_mvc_db /bin/bash
}

function composer() {
    cd html
    ./composer update
}

"$@"