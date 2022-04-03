serve:
	docker-compose -f infra/docker-compose.yml up mariadb php nginx

test:
	docker-compose -f infra/docker-compose.yml run phpunit

test-controllers:
	docker-compose -f infra/docker-compose.yml run phpunit --testsuite Controllers