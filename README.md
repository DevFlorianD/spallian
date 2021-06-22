# À savoir

Pour lancer les tests unitaires, rentrer dans le container app, puis changer de dossier -> blog, et enfin la commande : ./vendor/bin/phpunit

# Technical test

## Context

Spallian Blog is a simple, secured blog with an administrator and a regular user:

|        email        |   password   |
|---------------------|--------------|
|  admin@contact.com  |   admin123   |
|  user@contact.com   |   user123    |

## Objective

Yet the blog is empty, there is no existing article.

The goal is to implement the functionalities to see the list of articles and check the details, create, edit and delete a specific article.

The requested fields are the following:

- a title
- a subtitle (optional)
- a content
- a creation date
- an author

The administrator can delete any of the existing articles, but the user cannot.

*Bonus:*

Anything regarding the design of the blog is up to you, from CSS to JavaScript and their libraries/frameworks. **It is not mandatory though.**

Any additional feature (bundle, functionality, logic, best practice and so on) is welcomed.

## Installation

**[Check the tutorial](install.md)**
