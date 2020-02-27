vendor: composer.json composer.lock
	php composer.phar install --profile

phpunit:
	php vendor/bin/phpunit

validate-composer:
	php composer.phar validate --strict

validate-schema:
	php bin/console doctrine:schema:validate --skip-sync
	php bin/console doctrine:schema:validate --skip-sync --em=audit

validate-db:
	php bin/console doctrine:schema:validate
	php bin/console doctrine:schema:validate --em=audit

link-var:
	# Link the var directory /var to speed vagrant up
	rm -rf var
	mkdir -p var
	ln -sf /var/log/symfony/ var/log
