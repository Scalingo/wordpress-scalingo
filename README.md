# Scalingo 12-Factor WordPress Distribution

Based on [Bedrock](https://roots.io/bedrock/)

* Better folder structure
* Dependency management with [Composer](http://getcomposer.org) and [WordPress Packagist](https://wpackagist.org/)
* Easy WordPress configuration with environment specific files
* Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
* Autoloader for mu-plugins (use regular plugins as mu-plugins)
* Enhanced security (separated web root and secure passwords with [wp-password-bcrypt](https://github.com/roots/wp-password-bcrypt))

With few more features added by `Scalingo`:

* Configurable from var environment
* File Uploads sent to S3 Bucket by default with [S3-Uploads plugin](https://github.com/humanmade/S3-Uploads)

> Actual WordPress version : `6.6.1`

Please refer to the instructions in the [Scalingo documentation](https://doc.scalingo.com/platform/getting-started/getting-started-with-wordpress).

## Use in Development

### Requirements

* [Docker](https://docs.docker.com/install/)
* [Docker Compose](https://docs.docker.com/compose/install/)

### Updating WordPress version

Update package.json to update the WordPress branch you need.

Then run:

```shell
└> docker-compose run --rm web composer update
```

Run locally to test WordPress is working, then commit `composer.json` and `composer.lock`.

### Run locally

A Docker Compose file is available to run the WordPress locally. You first need
to install the dependencies with:

```bash
docker-compose run --rm composer install --prefer-source --no-interaction --ignore-platform-reqs
```

Then start the Nginx:

```bash
docker-compose up nginx
```

#### Install Wordpress Plugin

Simple command for install plugins:
```bash
docker-compose run --rm composer require --ignore-platform-reqs wpackagist-plugin/{PLUGIN_NAME}
```

You can find `plugins` on [Wordpress Packagist](https://wpackagist.org/search?q=&type=plugin&search=)

Example to install `akismet` plugin:
```bash
docker-compose run --rm composer require --ignore-platform-reqs wpackagist-plugin/akismet
```

#### Install Wordpress Theme

Simple command for install themes:
```bash
docker-compose run --rm composer require --ignore-platform-reqs wpackagist-theme/{THEME_NAME}
```

You can find `themes` on [Wordpress Packagist](https://wpackagist.org/search?q=&type=theme&search=)

Example to install `hueman` theme:
```bash
docker-compose run --rm composer require --ignore-platform-reqs wpackagist-theme/hueman
```

## Documentation

[Bedrock](https://roots.io/bedrock/) documentation is available at [https://roots.io/bedrock/docs](https://roots.io/bedrock/docs).
