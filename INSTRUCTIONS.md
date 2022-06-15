# Installation instructions

## With Docker

Used ports : 
- 8080 for adminer container
- 3306 for mysql container
- 80 for php / nginx container

1. Create a .env file by using `make env` using those values. User and Password are the same everywhere (excluding website's back-office)
   ```env
    MYSQL_USER=olivia #Or the name of your choice
    MYSQL_PASSWORD=password
    MYSQL_DATABASE=bilemo
    MYSQL_ROOT_PASSWORD=root
    ```

2. Launch Docker
Apply those commands in your terminal :

    2.1 Launch containers
    ```
    docker-compose build && docker-compose up -d
    ```

    2.2 Install PHP bundles
    ```
    docker-compose exec php composer install
    ```
    
3. **Create database tables**.
Database is already created.

In Docker, you can directly use containers' terminal. To do so, you can use this command from your Operating-System terminal:
```
$ docker-compose exec php exec bash
```

From there, you can execute the next three commands:

**Migrate**:
```
$ bin/console doctrine:migration:migrate
```

**Create fixtures**:
```
$ bin/console doctrine:fixtures:load
```

**In case of doubt, feel free to use**
```
$ bin/console list
```

It is also important to note that there is a Makefile at the root of the project. In there, you can find commands such as 
```
$ make dev
```

You can use `make help` to list the available commands.

---

## Without Docker

Symfony is agnostic, so you can install directly on a machine in order to develop using the framework. 

Select all `app/` content (it is advised to copy-paste the content), and move / paste in the adequate folders. There might be a need to proceed to some configuration. For instance, database.

You can use your usual XAMPP/MAMP/WAMP/LAMP config and place `app/` in your development folder.

To run the server, you can run the following command :
```sh
$ symfony serve
```

You will be able to run the API.