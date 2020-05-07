setup:
	composer install
	cp -n .env.example .env
	cp -n .env.example .env.testing
	sed -i "s/DB_CONNECTION=sqlite/DB_CONNECTION=sqlite\nDB_DATABASE=./database/db_for_testing.sqlite/" .env.testing
	php artisan key:gen --ansi
	touch database/database.sqlite || true
	touch database/db_for_testing.sqlite || true
	php artisan migrate
	php artisan db:seed --force

serve:
	php artisan serve

migrate:
	php artisan migrate

console:
	php artisan tinker

test:
	php artisan config:clear 
	php artisan test --env=testing

coverage:
	./vendor/bin/phpunit --coverage-clover ./build/logs/clover.xml

deploy:
	git push heroku

lint:
	composer phpcs -- --standard=PSR12 app routes tests

lint-fix:
	composer phpcbf app/Http/Controllers tests
