install:
	composer install

serve:
	docker-compose -f infra/docker-compose.yml up mariadb php nginx

test:
	docker-compose -f infra/docker-compose.yml run phpunit

test-controllers:
	docker-compose -f infra/docker-compose.yml run phpunit --testsuite Controllers

migrate:
	docker-compose -f infra/docker-compose.yml run db_migration

migrate-test:
	docker-compose -f infra/docker-compose.yml run db_migration --env=test