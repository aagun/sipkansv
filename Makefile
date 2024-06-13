.PHONY: help
.PHONY: artisan-test
.PHONY: artisan-service

help: ## Print help
	@awk 'BEGIN {FS = ":.*##"; printf "\nUsage:\n  make \033[36m<target>\033[0m\n\nTargets:\n"} /^[a-zA-Z_-]+:.*?##/ { printf "  \033[36m%-10s\033[0m %s\n", $$1, $$2 }' $(MAKEFILE_LIST)

lsa: ## Show all containers
	@docker container ls -a

ps: ## Show containers
	@docker compose ps

start: ## Start all containers
	@docker compose up -d

stop: ## Stop all containers
	@docker compose stop

restart: stop start ## Restart all containers

destroy: stop ## Remove all containers
	@docker compose down -v --remove-orphans

purge: destroy ## Remove all containers and remove local data
	@sudo rm -rf ./docker/mysql/volumes/

# Artisan
artisan-service: ## Create laravel service
	@php artisan make:interface "Services/$(name)Service"
	@php artisan make:class "Services/Impl/$(name)ServiceImpl"
	@php artisan make:provider "$(name)ServiceProvider"

artisan-test: ## Create test file
	@php artisan make:test "$(name)Test"

artisan-remigrate: ## Refresh laravel migration
	@php artisan migrate:refresh
