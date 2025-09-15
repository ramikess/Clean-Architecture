ifneq (,)
.error This Makefile requires GNU Make.
endif

.DEFAULT_GOAL := help
.PHONY: help bash-php bash-nginx bash-db bash-rabbitmq bash-mailcatcher db-anonymize-emails lint _lint-pcf _update-pcf

# Commande Docker Compose
DOCKER_COMPOSE_V2_EXISTS := $(shell command -v docker compose 2> /dev/null)
DOCKER_COMPOSE_CMD = $(if $(DOCKER_COMPOSE_V2_EXISTS),docker compose,docker-compose)
DOCKER_COMPOSE = $(DOCKER_COMPOSE_CMD) -p ddd

# Environnement par défaut
ENV=dev

# Commande yarn
YARN = $(DOCKER_COMPOSE) run --rm yarn

# ----------------------
# TARGETS UTILES
# ----------------------

help:
	@echo "Available targets:"
	@echo "  bash-php         Enter PHP container"
	@echo "  bash-nginx       Enter Nginx container"
	@echo "  bash-db          Enter Database container"
	@echo "  bash-rabbitmq    Enter RabbitMQ container"
	@echo "  bash-mailcatcher Enter MailCatcher container"
	@echo "  db-anonymize-emails  Anonymize database emails"
	@echo "  lint             Run all linters"
	@echo "  _lint-pcf        Run PCF linter"
	@echo "  _update-pcf      Update PCF definitions"

# ----------------------
# BASH DANS LES CONTENEURS
# ----------------------

bash-php:
	docker exec -ti ddd-php bash

bash-nginx:
	docker exec -ti ddd-nginx bash

bash-db:
	docker exec -ti ddd-database bash

bash-rabbitmq:
	docker exec -ti ddd-rabbitmq bash

bash-mailcatcher:
	docker exec -ti ddd-mailcatcher bash

