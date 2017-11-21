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

# Pour Behat : génération des snippets grâce au fichier book.feature créé
```
vendor/behat/behat/bin/behat --dry-run --append-snippets
```