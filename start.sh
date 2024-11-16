#!/bin/bash

# Start the PHP Artisan server.
php artisan serve &

# Start the NPM development server.
npm run dev &

# Wait indefinitely to keep the script running.
wait
