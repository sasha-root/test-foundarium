## Задача

````
Даны два списка. Список автомобилей и список пользователей.
C помощью laravel сделать api для управления списком использования автомобилей пользователями.
В один момент времени 1 пользователь может управлять только одним автомобилем. 
В один момент времени 1 автомобилем может управлять только 1 пользователь.
Код разместить на https://github.com/
Подготовить документацию в https://editor.swagger.io/
Обязательно наличие тестов.
````

### Ответы на самые частые вопросы

````
Под «апи для управления списком» подразумевается, в том числе администраторское АПИ для добавления / удаления автомобилей и/или редактирование пользователей? и то и то.

Что значит «управлять»? Как в каршеринге можно забронировать себе автомобиль? Или можно выбрать авто и как-то им управлять как радиоуправляемой машинкой?

привязать пользователя к авто.

Может быть что при выборе одного и того же пользователя могут быть разные машины?
нет, один пользователь - 1 машина.

Нужно ли внести эти два списка в базу данных?
Да

Надо оборачивать все в Docker?
Желательно, не обязательно.

Какую архитектуру стоит применить (к примеру DDD) или достаточного простой архитектуры?
будет плюсом DDD

````

## Start Laravel sail

````
1. composer install
2. scp -r ./docker/docker-compose-sail.yml ./docker-compose.yml
3. scp -r ./.env.example ./.env
4. Set environments
5. docker-compose up -d --build
6. docker-compose exec app php artisan key:generate
7. docker-compose exec app php artisan migrate 
````

## Run test 

````
1. scp -r ./.env.example ./.env.testing
2. Set environments 
3. scp -r ./docker/docker-compose-testing.yml ./docker-compose-testing.yml
4. sh run-local-test.sh
````




