# Teste Pastelaria
This project use PHP 7.4.1, MySQL 8.0.19 and Laravel 7

This project comes with some registered data to facilitate testing the api:
 - 7 Pastels
 - 1 Client
 - 1 Order with 3 pastels

## Api Documentation
This api has a postman documentation in https://documenter.getpostman.com/view/1084671/SzS1T8yR

## Postman file
The postman file is in this root directory (Doc88 Test.postman_collection.json)

## Running this api
Clone this repository, access the folder and follow theses instructions.

Create a `.env` file. You can copy the contents of the `.env.example`

Now you can simply execute the `docker-compose` command and wait the application to start:
`docker-compose up -d`


Note: the first time you run the docker command, it will take some time because it will download all dependencies and docker images.

Note²: To send emails, you must configure your `.env` file. You could use mailtrap for testing purpose.

## Route list
```
+-----------+---------------------------------+
| Method    | URI                             |
+-----------+---------------------------------+
| GET|HEAD  | *                               |
| GET|HEAD  | api/client                      |
| POST      | api/client                      |
| GET|HEAD  | api/client/create               |
| PUT|PATCH | api/client/{client}             |
| DELETE    | api/client/{client}             |
| GET|HEAD  | api/client/{client}             |
| GET|HEAD  | api/client/{client}/edit        |
| PUT       | api/client/{client}/restore     |
| POST      | api/order                       |
| GET|HEAD  | api/order                       |
| GET|HEAD  | api/order/client/{client}       |
| GET|HEAD  | api/order/create                |
| POST      | api/order/{client}/finish       |
| DELETE    | api/order/{order}               |
| PUT|PATCH | api/order/{order}               |
| GET|HEAD  | api/order/{order}               |
| GET|HEAD  | api/order/{order}/edit          |
| PUT       | api/order/{order}/restore       |
| POST      | api/pastel                      |
| GET|HEAD  | api/pastel                      |
| GET|HEAD  | api/pastel/create               |
| DELETE    | api/pastel/{pastel}             |
| PUT|PATCH | api/pastel/{pastel}             |
| GET|HEAD  | api/pastel/{pastel}             |
| GET|HEAD  | api/pastel/{pastel}/edit        |
| GET|HEAD  | api/pastel/{pastel}/photo       |
| PUT       | api/pastel/{pastel}/restore     |
| PUT       | api/pastel/{pastel}/updatePhoto |
+-----------+---------------------------------+
```
