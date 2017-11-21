sonLibrary
==========

# Install Symfony

```sh
composer install

mysql
create database sonlibrary;
exit

php app/console d:s:u --force

sudo nano /etc/nginx/sites-available/sonlibrary.test
location / {
    try_files $uri /app_dev.php$is_args$args;
}
sudo service nginx restart
```
