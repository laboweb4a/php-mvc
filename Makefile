VERSION = 0.0.1

.PHONY: up
up:
	@docker-compose up -d
	@printf "php-mvc project is up now"

run:
	@docker-compose up
	@printf "php-mvc project running"

.PHONY: down
down:
	@docker-compose down

.PHONY: restart
restart:
	@docker-compose restart

.PHONY: stop
stop:
	@docker-compose stop

.PHONY: build
build:
	@docker-compose build
