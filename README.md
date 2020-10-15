
# Anaaj Trade Management
In Pakistan anaaj commission agents still manage their daily basis records on registers which cause trouble in the end of month while calculating the profit loses or while managing individual accounts of customers. To solve that problem, we have developed a web based application.

## Features

- Manages daily loan transactions
- Manages daily oil, fertilizer, agricultural medicine, rice, wheat and diesel records
- Manages daily fertilizer, agricultural medicine, wheat and rice stocks
- Keeps the record of fertilizer, medicine traders
- Keeps the records of filling stations
- Keeps the individual records of every customer
- Generates transaction statistics for last month, last three months and for last six months

## Clone or Download and Setup the project

Use **git clone**. Get url by clicking on Code button at top right corner or simply download the zip folder. Follow the steps to setup or download dependencies.
- Open cmd or terminal inside project directory
- Type command **composer install** and hit enter.
- Type command **npm install** and hit enter.
- Copy **.env.example** file and change the name to **.env**.
- Update file with your database credentials.
- Type command **php artisan migrate** and hit enter.
- Type command **php artisan db:seed** and hit enter.
- Now type command **php artisan serve** and hit enter to start laravel developement server.
