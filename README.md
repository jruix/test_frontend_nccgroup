# Jonathan Ruiz Peinado

Problem description:

* Create an interface that allows you to enter a series of dates, each with a corresponding url and total page response time in seconds. Any data previously entered should be displayed in a table.

* Display the data in some kind of graphical form (e.g. bar chart)

* Bonus question (if you have time): The user should have the option to sort the data by any of the table columns. It should also be possible to amend and/or delete the data after it has been entered.

* Bonus question (if the rest were too easy!): allow the user to manipulate the graphic you produced in question two in some way and make the data they entered update automatically to reflect the change.

## Installation

To run it, make sure you have PHP installed, and type the following commands in your terminal:

```
$ cd /path/to/project
$ composer install
$ php -S localhost:8000 web/index.php
```

Open your browser and type: ```localhost:8000```. Enjoy!

## Technologies used

* Silex (PHP framework) + using @fabpot's structure (look [here](https://github.com/silexphp/Silex-Skeleton))
* An interface for the saving method; also implemented three different: Database, Redis and CSV (using CSV by default).
I just implemented tests for that one (the CSV), but It would be feasible to implement tests for the rest of the datastores.
Actually, I would write an integration test (by using a local Redis instance and a SQLite for the database).

## Running tests

```./vendor/bin/phpunit```
