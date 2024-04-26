<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Setup

### Install PHP & Composer
For our project we need to install PHP 8.2 and Composer to 
install the dependencies and run the project with sail.

After you installed PHP and Composer you can check the version
with the following commands:
```
php -v
```
```
composer -V
```

Then update composer
```
composer update
```

#### Install missing packages
If you are missing some packages, you can install them.
What is probably missing is php-xml and unzip.:

Command for php-xml ubuntu:
```
sudo apt-get install php8.2-xml
```

Command for unzip ubuntu:
```
sudo apt install unzip
```

## Setup Environment-Variables
First copy the .env.example file to .env and update the values.

### DB Connection
Activate all database connections you need in the .env file.

As we use mysql DB_CONNECTION and DB_HOST has to be set to mysql.
We also use the default port 3306.

Add your database name, username and password to the .env file.
You are free to choose the database name, username and password.

Example:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=tms-backend
DB_USERNAME=tms-root
DB_PASSWORD=tms-backend-user-482
```

### APP Key

Generate a new key for the app with the following command:
```
php artisan key:generate
```
Set the APP_KEY in the .env file to the generated key.

### Sail Setup & WSL2

<div style="color: #991228">
<strong>
Windows Users may experience some issues with file permissions. Therefore it's highly recommended to store the files in the WSL2 Distro File-System.
</strong>
</div>
<br />

Create a alias for the sail command to make it easier to use.
```bash
# (optional) create shortcut for sail command
echo 'alias sail="./vendor/bin/sail"' >> ~/.bashrc
source ~/.bashrc
```
Then you can start the sail setup with the following command:
```
# Run Docker in detached mode (background)
sail up -d
```
Then setup the DB with the following command:
```
# Run migrations 
sail artisan migrate
```

#### Other sail commands
```
# install composer dependencies (needed for install plugins later)
sail composer install

# (development only!!) to populate system with fake data. Before seeding create test user (see next chapter for more info)
sail artisan db:seed
```


## Setup Xdebug

### Install Xdebug
First, you have to install the xdebug in your project or docker setup.
Since this is done in sail setup we are using for us, we don't need to take
care about it.

### Config Xdebug
Usually we create a "xdebug.ini" and copy or mount it in our setup to
set the configuration parameters of xdebug like for example:

```
COPY xdebug.ini  $PHP_INI_DIR/conf.d/
```

But since we're using sail, sail gives us parameter we can set in the ``.env``
and we don't need to config ``xdebug.ini`` and use the parameters instead which will do the
job for us.

### Setup with sail, not working sail parameters, check if xdebug is enabled

#### Sail parameters do not work
The first problem will appear while setup and wondering why it's not working.
The reason for it is that the sail parameters are not working the way we expect.

#### Check Xdebug is activated
To check this you can grab an entry point in your application, a controller e.g, and
add the following code:
```
xdebug_info();
exit;
```
If you call the page this will give you an overview about the current xdebug config.
We are aiming for an enabled set called ``Step Debugger``.

#### Config Xdebug with sail
Now we need to set the xdebug config in our sail environment.

First we need our ``xdebug.ini``. Create a directory in your project root
called ``.docker``.

> **IMPORTANT**:
> Note that in another version of sail you have to use a different file name and path.

Create our ini ``20-xdebug.ini`` in the directory and add the following parameters:
```
zend_extension=xdebug.so
[xdebug]
xdebug.start_with_request=yes
xdebug.discover_client_host=true
xdebug.max_nesting_level=256
xdebug.remote_handler=dbgp
xdebug.client_port=9003
xdebug.idekey=Docker
xdebug.mode=develop,debug
xdebug.client_host=host.docker.internal
```

Now we have to mount this in the sail setup container in our ``docker-compose.yaml``.
Add the following mapping to the volume of the sail backend.
```
- './.docker/20-xdebug.ini:/etc/php/8.2/cli/conf.d/20-xdebug.ini'
```

Example (should look like this):
```
services:
    laravel.test:
        build:
            context: ./vendor/laravel/sail/runtimes/8.2
            dockerfile: Dockerfile
            args:
                WWWGROUP: '${WWWGROUP}'
        image: sail-8.2/app
        extra_hosts:
            - 'host.docker.internal:host-gateway'
        ports:
            - '${APP_PORT:-80}:80'
            - '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
        environment:
            WWWUSER: '${WWWUSER}'
            LARAVEL_SAIL: 1
            PHP_IDE_CONFIG: serverName=tms-backend
            IGNITION_LOCAL_SITES_PATH: '${PWD}'
        volumes:
            - '.:/var/www/html'
            - './.docker/20-xdebug.ini:/etc/php/8.2/cli/conf.d/20-xdebug.ini'
```

You can now restart the setup and checkout the xdebug info page if you want to see if
the changes does what we want.

### Visual Studio Code

### Install xdebug extension
VSCode doesn’t come with support for PHP Xdebug built in, so you need to add an extension.
You probably want to download the one called “PHP Debug” with the most downloads

![install xdebug extension](/readme/assets/xdebug_extension.png "install xdebug extension")

### Config your setup for docker containers
If you didn't setup your vs-code settings yet, create a ``.vscode`` directory in your project root,
and add a ``launch.json`` file to it. It should look like this:
```
{
    "version": "0.2.0",
    "configurations": [
        {
            "name": "Listen for Xdebug",
            "type": "php",
            "request": "launch",
            "port": 9003,
            "pathMappings": {
                "/var/www/html": "${workspaceFolder}"
            },
            "hostname": "0.0.0.0",
        }
    ]
}
```
You can now start listening with the xdebug.

![xdebug extension listener](/readme/assets/xdebug_extension_listen.png "xdebug extension listener")

Now use the bar to debug.

![xdebug extension bar](/readme/assets/xdebug_extension_bar.png "xdebug extension bar")

### PHPStorm

In the upper right corner, click on the debug options. Then on 'Edit configurations'.

![edit config](/readme/assets/add_config.avif "edit config")

You'll be presented with a dialog. Click on add new configuration

![add new config](/readme/assets/add_config_2.avif "add new config")

Choose the option PHP Remote debug

![add PHP Remote debug](/readme/assets/add_config_3.avif "add PHP Remote debug")

Give your debug config a name like ``backend debugger`` or what ever.

![name PHP Remote debug](/readme/assets/name_debug_config.avif "name PHP Remote debug")

Now click on 'Filter debug connection by IDE key' and click on the triple dot button of the servers option to add a new server.

Name your server Docker. To the host, add either 0.0.0.0 or localhost or the name you address the server
if using dns.

![add a server](/readme/assets/add_server.avif "add a server")

Make sure to map your project's root directory to the container's /var/www/html.
Click OK. Then, on the previous dialog select the Docker server. Also, add the Docker IDE session key.

![add session key](/readme/assets/add_session_key.avif "add session key")

Now you are good to go!!

General debug settings in addition
![general debug sessions](/readme/assets/php_storm_general_debug_config.avif "general debug sessions")
