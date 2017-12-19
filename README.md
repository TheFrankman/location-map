# Map of Me

## Introduction
This is an application created using the Zend Framework MVC layer and module systems.
It allows you to add a list of locations you have lived, visited and want to visit to a google map.

A demo is available at locations.frankclark.xyz as setting this up will likely be time consuming.

## Local Setup
I created this project using MAMP with apache but either of the below configurations should work for you.
Once the localhost is configured you need to create a database called `locations`.

Provided you are using MYSQL I've provided a sample database of the places I have lived, visited and want to visit that
can be imported. This is located in the project root `locations.sql`

When the database is created you will need to : 

Rename the file located at `project_root/config/autoload/local.example.php` to `local.php` within the same directory
updating the username and password to your own.

I've included the vendor directory to prevent any issues with composer.

### Apache setup

To setup apache, setup a virtual host to point to the public/ directory of the
project and you should be ready to go! It should look something like below:

```apache
<VirtualHost *:80>
    ServerName locations.localhost
    DocumentRoot /path/to/locations/public
    <Directory /path/to/locations/public>
        DirectoryIndex index.php
        AllowOverride All
        Order allow,deny
        Allow from all
        <IfModule mod_authz_core.c>
        Require all granted
        </IfModule>
    </Directory>
</VirtualHost>
```

### Nginx setup

To setup nginx, open your `/path/to/nginx/nginx.conf` and add an
[include directive](http://nginx.org/en/docs/ngx_core_module.html#include) below
into `http` block if it does not already exist:

```nginx
http {
    # ...
    include sites-enabled/*.conf;
}
```


Create a virtual host configuration file for your project under `/path/to/nginx/sites-enabled/locations.localhost.conf`
it should look something like below:

```nginx
server {
    listen       80;
    server_name  locations.localhost;
    root         /path/to/locations/public;

    location / {
        index index.php;
        try_files $uri $uri/ @php;
    }

    location @php {
        # Pass the PHP requests to FastCGI server (php-fpm) on 127.0.0.1:9000
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_param  SCRIPT_FILENAME /path/to/locations/public/index.php;
        include fastcgi_params;
    }
}
```
## TODOS

- Repositories and Interfaces
- Configurable Map Center
- Allow creation of accounts and views for each account
- Sharing functionality
- Tidy up call to geo location api
- Add more information to info popup (allowing custom fields, tags)
- Add your own google api key
- Much more...