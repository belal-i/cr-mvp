## CR Laravel-App

### Requirements (Docker, preferred)

* Docker - see the following:
  * https://docs.docker.com/engine/install/ubuntu/
  * https://docs.docker.com/engine/install/ubuntu/#install-using-the-repository
  * https://docs.docker.com/engine/install/linux-postinstall/
* MySQL - this application is built specifically to connect to a 
  MySQL database. The docker-compose.yml that it ships with includes
  a MySQL configuration that you can use to easily set up a local
  development environment, but this is indeed only intended for
  local development. When deploying to a production server or other remote
  environment, you need to provide your own MySQL server, and properly 
  configure this app to connect with it.

### Requirements (LAMP stack, deprecated)

Typical LAMP stack setup with minimum PHP 8.2 - however, in a future
version, this application will run in a Docker network.

#### Required PHP extensions

These PHP extensions need to be installed on the web server running this
application, whether production server or local development machine:

* mysql
* xml
* mbstring
* intl
* curl
* zip (dev)

On Ubuntu, and likely on other distros, the full package name is prefaced by
`phpVERSION-`, so to install, do something like `apt install php8.2-mysql`.

TODO: Define platform requirements in composer.json? See https://getcomposer.org/doc/06-config.md#platform

### Installing

#### Production/Stage/etc. (Docker, preferred)

For the time being, we are using DigitalOcean's _App Platform_, with the
hopes that they will make things simpler. In the future, we might work to
make this more flexible/portable.

Useful links:

* https://docs.digitalocean.com/products/container-registry/getting-started/quickstart/
* You need DigitalOcean's doctl: https://docs.digitalocean.com/reference/doctl/how-to/install/
* You need access tokens:
  * https://docs.digitalocean.com/reference/api/create-personal-access-token/
  * Generate tokens here: https://cloud.digitalocean.com/account/api/tokens
  * Give doctcl access to the new token: `doctl auth init --context cr-web`

If you installed doctl with Ubuntu Snap, you need to grant doctl permissions
with: `sudo snap connect doctl:dot-docker`.

We have a container registry at DigitalOcean. If you did everything right
so far, you should be able to authenticate your local Docker installation
to it, with: `doctl registry login`.

Tag an image (example): `docker tag cr-laravel-app:1.2.0-beta-1 registry.digitalocean.com/city-residence/cr-laravel-app`
Then, push that image: `docker push registry.digitalocean.com/city-residence/cr-laravel-app`

##### Database

For now, we need the database to run in a VPS, and for that to be publicly
available. This is because we still need to misuse the database seeder
as our "ETL-Loader". Doing it with a managed database has very slow performance.
So we need to be able to run the seeder directly on the file system of the
database server, and the only way to do that is with a VPS.

You can use [Lampsible](https://github.com/saint-hilaire/lampsible) to set that up:

* `lampsible user@host mysql --database-username someuser --database-name laravel`
* `lampsible user@host php --php-extensions mysql,xml,mbstring`

Then, to make the database reachable from outside, SSH into the VPS, and:

* In /etc/mysql/mysql.conf.d/mysqld.cnf, the "bind-address" fields should
  have the value `0.0.0.0`, not `127.0.0.1`.
* MySQL (maybe implement this in Lampsible?):
  - `CREATE USER 'username'@'%' IDENTIFIED BY 'password';`
  - `GRANT ALL PRIVILEGES  ON *.* TO 'username'@'%' WITH GRANT OPTION;`
  - `FLUSH PRIVILEGES;`

Finally, when that is set up, upload the latest "legacy-build" (see below)
to the database server, along with a normalized.json containing production data,
and use them to run the seeder on the database server.

Special care must be given to the "Seeder-Laravel-App's" .env file.
`BACKPACK_DEFAULT_ADMIN_PASSWORD` must be a real and strong password.
Everything should be as close to production as possible, except
for the local database connection.
Also, I haven't verified it, but I suspect that the `APP_KEY` must
be the same as what will run in Stage, Production, etc.
Currently there are some tricky issues about token mismatch and so on.

##### Legacy builds

Though we are moving towards building and deploying with Docker, we still
need to maintain "legacy builds" - basically archive files with dependencies
installed, ready to extract in a webroot. This because of the
database issues described above. So with every release,
along with pushing a new Docker image to the container registry,
we also need to follow these steps:

* Clone a fresh copy of the code into a local directory, check out
  desired version.
* `composer install`
* `npm install`
* `npm run production`
* `rm -rf .git*`
* Make an archive of that directory, i.e. `tar -czf cr-laravel-app-1.0.2.tar.gz cr-laravel-app/`
* Upload that to GitHub release page.

#### Production/Stage/etc. (LAMP stack, deprecated)

Set up a LAMP stack and extract the latest build into /var/www/html/...
and some other steps. Use [Lampsible](https://github.com/saint-hilaire/lampsible)
to perform the entire installation in a single local command. See the
[wiki](https://redmine.city-residence.de/projects/laravel/wiki#Deployment) for
more info.

#### Local (Docker, preferred)

* Build: `docker build -t cr-laravel-app:SOME_TAG .`
* In the code, you need a working .env file, with `APP_KEY`, database credentials,
  and so on.
* `docker compose up -d`
* Browse to http://localhost:8000. In the first few seconds, you will encounter
  the error "Connection was reset". This needs to be improved, but for now,
  is to be expected.
* When you do it for the first time, you have to seed the database.
  Shell into the container (`docker exec -ti cr-laravel-app bash`) and then
  run the seeder: `php artisan db:seed`

#### Local (legacy)

* `composer install`
* `npm install`
* `npm run dev`
* `cp .env.example .env` and enter database credentials
* `php artisan key:generate`
* `php artisan migrate`
* `php artisan db:seed`
* `php artisan serve`
* Browse to http://localhost:8000
* RTFS

### Getting production data into the database

You need to run the ETL-Pipeline (https://github.com/city-residence/cr-etl),
then, replace the fake data file /database/normalized.json of cr-laravel-app
with the normalized.json (containing real data) generated by cr-etl.

The development of cr-etl follows closely with this application.
For this reason, you need to make sure to use the right version of cr-etl:

Required cr-etl version: `v1.3.0`

### Troubleshooting

We are still cleaning up some issues. Some common problems that might arise,
and their fixes:

* SQL table not found: This is because migrations failed to run when the
  container started. Just restart the container, that should do the trick.
* Undefined array key 0 (local dev environment): You need to run the seeder. 
  Simply shell into the container and run `php artisan db:seed`.
* When logging into remote admin, HTTP error 419, strange redirects, and so on.
  Make sure the `user` in the database has the `role` `ADMIN`.
  Also, this is quite tricky... deleting browser history, clearing app cache, and
  so on. But it should work.
  I suspect that the `APP_KEY` of the "Seeder Laravel App" must be the same
  as the one on Stage/Production. 

### Setting up the Backpack admin panel

https://backpackforlaravel.com/docs/6.x/installation

### Bumping version for frontend cache busting

2 places in the code have the application's version number, which needs to be
bumped with every new release:
* config/app.php (at the bottom)
* webpack.mix.js
