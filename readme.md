Set up this project
Database:
First set up a database named chuck_norris_jokes on channel 3600 

Run the migrations:
php bin/console make:migration
php bin/console doctrine:migrations:migrate

Run the server:
symfony server:start

Routes:

For 10 random jokes:
http://localhost:8000/jokes

To save a joke to favorites:
http://localhost:8000/save/[number]
(example http://localhost:8000/save/1)

To remove a joke:
http://localhost:8000/save/[number]
(example http://localhost:8000/save/1)

For all favorite jokes:
http://localhost:8000/favorites