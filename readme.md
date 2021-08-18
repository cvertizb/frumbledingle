## Setup Instructions
- `git clone` this repo
- Run `composer install`
- Run `npm install`
- Make sure to set the database information your `.env` file
- Run `php artisan migrate --seed`, it will populate some data in the DB.
- Run `npm run dev` or `npm run watch` to compile the Vue components.
- Run `php artisan serve`
- To test the endpoints run `./vendor/bin/phpunit`