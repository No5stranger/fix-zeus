composer:
	@echo ">-------- get composer.phar --------"
	curl -sS https://getcomposer.org/installer | php

build:
	@echo ">-------- building the zeus --------<"
	mkdir thrift/packages
	thrift -nowarn --gen php:opp -out thrift/packages/ thrift/gfix.thrift
	@echo ">-------- building the environment --------<"
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

clean-test:
	@echo ">-------- clear tmp test file --------<"
	rm -rf thrift/packages/*
