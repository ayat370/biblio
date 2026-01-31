#!/bin/bash

# setup_db.sh - Script to refresh and seed the database

echo "Refreshing database and running seeders..."

# Check if PHP is installed locally
if command -v php &> /dev/null; then
    echo "Running with local PHP..."
    php artisan migrate:fresh --seed
elif command -v docker &> /dev/null; then
    echo "Running with Docker (container: laravel_app)..."
    docker exec -t laravel_app php artisan migrate:fresh --seed
else
    echo "Error: Neither PHP nor Docker found. Please install PHP or ensure Docker is running."
    exit 1
fi

echo "Database seeding completed successfully!"
