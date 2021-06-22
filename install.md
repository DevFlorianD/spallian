# Installation

In this project, the environment, the database and the authentication are already set.

## Environment

- PHP 7.4
- Symfony 5.2
- MySQL 8.0

## Prerequisites

- Git: 2.3+
- Docker-Engine: 19.03.0+
- Docker-Compose: 1.27.0+

*Ideally*, make sure to have the very latest versions.

## Instructions

1. Clone the repository:

`git clone https://github.com/devSpallian/spallian_blog.git --config core.autocrlf=input`

2. Switch to the repository folder:

`cd spallian_blog`

3. Build and start the containers:

`docker-compose up -d --build`

If you want to destroy the containers in order to rebuild them right after:

`docker-compose down --remove-orphans --volumes`

4. Connect to the application's container:

`docker exec -ti app bash`

5. Switch to the application folder:

`cd blog`

6. Install the dependencies:

`composer install` or `composer update -W`

7. Apply the migrations and the fixtures:

`bin/initialize`

8. Launch the built-in Symfony server:

`symfony serve -d`

9. On your web browser, go to:

`http://localhost:8090`
