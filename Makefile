PATH := $(shell pwd)/bin:$(PATH)

install:
	docker build -t free-elephants/static-http-client-dev .
	composer install

test:
	vendor/bin/phpunit
