# Executables (local)
DOCKER_COMP = docker compose

# Docker containers
PHP_CONT = $(DOCKER_COMP) run --rm php

.PHONY: install test start stop

install:
	@$(PHP_CONT) composer install

update:
	@$(PHP_CONT) composer update

test:
	@$(PHP_CONT) vendor/bin/phpunit
