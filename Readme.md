## Install
1. composer install
2. Copy env.sample to .env and update env vars
3. run create-db.sql to create your test db
4. run a test e.g. ``


SHOW VARIABLES LIKE "%general_log%";
root@work:/etc/mysql# cat conf.d/mysql.cnf
[mysql]

[mysqld]
general_log_file = /var/log/mysql/general.log
general_log      = 1