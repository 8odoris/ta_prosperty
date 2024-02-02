# Laravel 10.x REST APi
This API is created using Laravel 10.42.0. It is created to handle Spy entities. A protected route is also added, which is accessed via Bearer token.


#### Usage
Clone the project via git clone or download the zip file.
##### .env
Copy contents of .env.example file to .env file. Create a database and connect your database in the .env file.
##### Composer Install
cd into the project directory via terminal and run the following  command to install composer packages.
###### composer install
##### Generate Key
then run the following command to generate fresh key.
###### php artisan key:generate
##### Run Migration
then run the following command to create migrations in the database.
###### php artisan migrate
##### Database Seeding
then run the following command to seed the database with dummy content.
###### php artisan db:seed
##### Serve App
finally run the following command to serve the app.
###### php artisan serve

### API EndPoints
* Auth POST http://127.0.0.1:8000/api/v1/login (user@example.com/password)
* Spy GET List http://127.0.0.1:8000/api/v1/spies
* Spy POST Create http://127.0.0.1:8000/api/v1/spies
* Spy GET Random http://127.0.0.1:8000/api/v1/spies/random
