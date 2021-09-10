## Test app for IDC restaurants API

Testing application for get restaurants and their menu from IDC apiary API based on Symfony framework

## Setup
- clone the project from github
- run composer install locally or in project container
- run npm install locally or in project container(you need to install it there)
- run run dev
- copy .env.dist to .env.local
- fill in restaurants API url

## How to run
run docker-compose up in project working directory

## Test results
- Check localhost:8085 in your browser and you should see page with results, if any is present
- run tests locally or in container via:  `php bin/phpunit`

