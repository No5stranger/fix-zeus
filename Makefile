test:
	@echo ">-------- phpunit testing --------<"
	vendor/bin/phpunit -c phpunit.xml.dist

test-with-coverage:
	@echo ">-------- phpunit testing --------<"
	vendor/bin/phpunit -c phpunit.xml.dist --coverage-text
