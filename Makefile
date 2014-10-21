composer:
	echo ">-------- get composer.phar --------"
	curl -sS https://getcomposer.org/installer | php

build:
	echo ">-------- building the environment --------<"
	php composer.phar install

update:
	echo ">-------- update packages --------<"
	php composer.phar update

test:
	@echo ">-------- phpunit testing --------<"
	vendor/bin/phpunit -c phpunit.xml.dist

test-with-coverage:
	@echo ">-------- phpunit testing --------<"
	vendor/bin/phpunit -c phpunit.xml.dist --coverage-text
