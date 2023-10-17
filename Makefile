##
# Makefile to help manage docker-compose services
#
# Built on list_targets-Makefile:
#
#     https://gist.github.com/iNamik/73fd1081fe299e3bc897d613179e4aee
#
.PHONY: help about args list targets services build up down rebuild clean start status ps logs stop restart sh bash shell

# If you need sudo to execute docker, then udpate these aliases
#
DOCKER         := docker
DOCKER_COMPOSE := docker-compose

# Default docker-compose file
#
COMPOSE_FILE_DEFAULT_NAME := docker-compose.yml

# Default container for docker actions
# NOTE: EDIT THIS TO AVOID WARNING/ERROR MESSAGES
#
CONTAINER_DEFAULT := CORE_CBS

# Shell command for 'shell' target
#
SHELL_CMD := /bin/bash

ME := $(realpath $(firstword $(MAKEFILE_LIST)))

# Expected to be parent folder of compose file
# Contains trailing '/'
#
PWD := $(dir $(ME))

container ?= $(CONTAINER_DEFAULT)
file      ?= $(PWD)$(COMPOSE_FILE_DEFAULT_NAME)
service   ?=
services  ?= $(service)

.DEFAULT_GOAL := help

##
# help
# Displays a (hopefully) useful help screen to the user
#
# NOTE: Keep 'help' as first target in case .DEFAULT_GOAL is not honored
#
help: about targets args ## This help screen
ifeq ($(CONTAINER_DEFAULT),)
	$(warning WARNING: CONTAINER_DEFAULT is not set. Please edit makefile)
endif

about:
	@echo
	@echo "Makefile to help manage docker-compose services"

args:
	@echo
	@echo "Target arguments:"
	@echo
	@echo "    " "file"      "\t" "Location of docker-compose file (default = './$(COMPOSE_FILE_DEFAULT_NAME)')"
	@echo "    " "service"   "\t" "Target service for docker-compose actions (defauilt = all services)"
	@echo "    " "services"  "\t" "Target services for docker-compose actions (defauilt = all services)"
	@echo "    " "container" "\t" "Target container for docker actions (default = '$(CONTAINER_DEFAULT)')"

##
# list
# Displays a list of targets, using '##' comment as target description
#
# NOTE: ONLY targets with ## comments are shown
#
list: targets ## see 'targets'
targets:  ## Lists targets
	@echo
	@echo "Make targets:"
	@echo
	@cat $(ME) | \
	sed -n -E 's/^([^.][^: ]+)\s*:(([^=#]*##\s*(.*[^[:space:]])\s*)|[^=].*)$$/    \1	\4/p' | \
	sort -u | \
	expand -t15
	@echo

##
# services
#
services: ## Lists services
	@$(DOCKER_COMPOSE) -f "$(file)" ps --services

init: down \
	network \
	build \
	up \
	composer-install \
	cp-env \
	artisan-key-generate


##
# build
#
build: ## Builds service images [file|service|services]
	@$(DOCKER_COMPOSE) -f "$(file)" build $(services)

network:
	  docker network create example-laravel-some-idea || true

composer-install:
	docker exec example-laravel-some-idea_app composer install

composer-update:
	docker exec example-laravel-some-idea_app composer update

composer-require:
	docker exec example-laravel-some-idea_app composer require $(name)


composer-remove:
	docker exec example-laravel-some-idea_app composer remove $(name)

cp-env:
	docker exec example-laravel-some-idea_app cp .env.example .env

artisan-key-generate:
	docker exec example-laravel-some-idea_app  php artisan key:generate

laravel:
	docker exec example-laravel-some-idea_app  php artisan $(name)

artisan-migrate:
	docker exec example-laravel-some-idea_app  php artisan migrate

project-cs-check:
	docker exec example-laravel-some-idea_app  ./vendor/bin/php-cs-fixer fix -vvv --dry-run --show-progress=dots --config=./docker/cs-fixer/.php-cs-fixer.php --allow-risky=yes

project-cs-fix:
	docker exec example-laravel-some-idea_app ./vendor/bin/php-cs-fixer fix -vvv --show-progress=dots --config=./docker/cs-fixer/.php-cs-fixer.php --allow-risky=yes

cs-fix-path:
	docker exec example-laravel-some-idea_app ./vendor/bin/php-cs-fixer fix --path-mode=intersection $(path) -vvv --show-progress=dots --config=./docker/cs-fixer/.php-cs-fixer.php --allow-risky=yes

phpunit:
	docker exec example-laravel-some-idea_app php artisan test --parallel --processes=4

phpunit-path:
	docker exec example-laravel-some-idea_app ./vendor/bin/phpunit  --filter  $(path)

phpstan:
	docker exec example-laravel-some-idea_app ./vendor/bin/phpstan analyse --memory-limit=2G
##
# up
#
up: ## Starts containers (in detached mode) [file|service|services]
	@$(DOCKER_COMPOSE) -f "$(file)" up --detach $(services)

##
# down
#
down: ## Removes containers (preserves images and volumes) [file]
	@$(DOCKER_COMPOSE) -f "$(file)" down

##
# rebuild
#
rebuild: down build ## Stops containers (via 'down'), and rebuilds service images (via 'build')

##
# clean
#
clean: ## Removes containers, images and volumes [file]
	@$(DOCKER_COMPOSE) -f "$(file)" down --volumes --rmi all

##
# start
#
start: ## Starts previously-built containers (see 'build') [file|service|services]
	@$(DOCKER_COMPOSE) -f "$(file)" start $(services)

##
# ps
#
status: ps ## see 'ps'
ps:        ## Shows status of containers [file|service|services]
	@$(DOCKER_COMPOSE) -f "$(file)" ps $(services)

##
# logs
#
logs:  ## Shows output of running containers (in 'follow' mode) [file|service|services]
	@$(DOCKER_COMPOSE) -f "$(file)" logs --follow $(services)

##
# stop
#
stop: ## Stops containers (without removing them) [file|service|services]
	@$(DOCKER_COMPOSE) -f "$(file)" stop $(services)

##
# restart
#
restart: stop start ## Stops containers (via 'stop'), and starts them again (via 'start')

##
# shell
#
sh:    shell ## see 'shell'
bash:  shell ## see 'shell' (may not actually be bash)
shell:       ## Brings up a shell in default (or specified) container [container]
ifeq ($(container),)
	$(error ERROR: 'container' is not set. Please provide 'container=' argument or edit makefile and set CONTAINER_DEFAULT)
endif
	@echo
	@echo "Starting shell ($(SHELL_CMD)) in container '$(container)'"
	@$(DOCKER) exec -it "$(container)" "$(SHELL_CMD)"
