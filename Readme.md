## Install
This is a sandbox environment to facilitate learning Doctrine 2. 

It uses PHPUnit to run unit tests against the database - something you wouldn't do in a production setting but handy for taking Doctrine for a spin.

Each tests run in isolation. The setup for each test scans the directory of the running test to find the Doctrine entities and then drops and creates them in the database.

There is a `cli-config` which the `doctrine`  command line utility requires.


To get going: 

1. `composer install`
2. Copy `env.sample` to `.env` and update env vars
3. connect to your mysql instance using your preferred mysql clinet and run `create-db.sql` to create your test db 
4. `source .env` 
5. `phpunit --bootstrap ./bootstrap.php src/HelloWorld`


## Optional
Enable the the general log file so you can see the actual sql being run against the database.

Beware of enabling the general if your doctrine database is on the same mysql server as another database which runs a lot of queries. Your log file will grow very large, very quickly.


Update `/etc/mysql/conf.d/mysql.cnf` and add the following `mysqld` section
```
[mysqld]
general_log_file = /var/log/mysql/general.log
general_log      = 1
```

restart mysql `sudo service mysql restart` or equivalent for your platform

If you ssh into your mysql server and `tail -f /var/log/mysql/general.log` you should now see all queries running against your database.

To confirm that general logging is configured correctly, log into your mysql server and run the following

```SHOW VARIABLES LIKE "%general_log%"```


## Troubleshooting
`Doctrine\DBAL\Exception\ConnectionException: An exception occurred in driver: SQLSTATE[HY000] [2002] No such file or directory`  
Check your `HOST` database configuration in `.env`. 


`Doctrine\DBAL\Exception\ConnectionException: An exception occurred in driver: SQLSTATE[HY000] [1045] Access denied for user 'root'@'10.9.0.34' (using password: YES)`  
`USERNAME` or `PASSWORD` is incorrect in `.env`

`phpunit: command not found`  
make sure you source your `.env` prior to running phpunit


`PHP Fatal error:  Uncaught Dotenv\Exception\InvalidPathException: Unable to read any of the environment file(s) at [/Volumes/code/php/doctrine/test/.env]. in /Volumes/code/php/doctrine/test/vendor/vlucas/phpdotenv/src/Loader.php:133`  
Make sure your env file is named `.env`.

`Error: Call to undefined function createEntityManager()`  
Make sure you use the provided bootstrap using either the `phpunit --bootstrap` command line option or configure PHPUnit to use it under preferences in PHPStorm





