# WorkShop_PHP
* !!! PB de sécurité 

```
symfony/security-http 
&
symfony/http-foundation
sont à monter de versions
```

* Workshop fait avec Benjamin Oriol et DubMan21

```
 projet fait en Symfony 5 - découverte de Symfony pour moi
```

* Clone the project

```
  git clone https://github.com/benjamin-oriol/WorkShop_PHP.git
```
Then move in.

* Install dependencies

```
  composer install
```
* Install faker

```
  composer require fzaninotto/faker
```

* Create the database

```
  php bin/console doctrine:database:create
```
You may need to modify the DATABASE_URL in the .env (or .env.local ...)

* Execute the migrations

```
  php bin/console doctrine:migrations:migrate
```

* Load the fixtures

```
  php bin/console doctrine:fixtures:load
```
