# Makefile to mirror CI commands

.PHONY: phpstan-json-output phpstan-parse test

# Default values
DB_HOST ?= 127.0.0.1

# Run PHPStan (JSON output)
phpstan-json-output:
	vendor/bin/phpstan analyse --memory-limit=1G --error-format=json > phpstan.json
	cat phpstan.json

# Parse and format PHPStan results
phpstan-parse: phpstan.json
	php .github/scripts/parse-phpstan-results.php phpstan.json > phpstan-report.md
	cat phpstan-report.md

# Run tests
test:
	DB_HOST=$(DB_HOST) vendor/bin/phpunit
