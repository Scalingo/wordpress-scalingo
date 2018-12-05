# Scalingo 12-Factor Wordpress Distribution

* Configurable from environment
* Uploads sent to S3 by default

[![Deploy to Scalingo](https://cdn.scalingo.com/deploy/button.svg)](https://my.scalingo.com/deploy)

## Features

Based on [Bedrock](https://roots.io/bedrock/)

* Better folder structure
* Dependency management with [Composer](http://getcomposer.org)
* Easy WordPress configuration with environment specific files
* Environment variables with [Dotenv](https://github.com/vlucas/phpdotenv)
* Autoloader for mu-plugins (use regular plugins as mu-plugins)
* Enhanced security (separated web root and secure passwords with [wp-password-bcrypt](https://github.com/roots/wp-password-bcrypt))

## Requirements

* PHP >= 5.6
* Composer - [Install](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

## Installation

1. Clone this distribution

```
git clone https://github.com/Scalingo/scalingo-wordpress
cd scalingo-wordpress
scalingo create my-wordpress
scalingo addons-add scalingo-mysql free
```

2. Update the application environment through the dashboard or with the
   [Scalingo command line](http://cli.scalingo.com) `scalingo env-set
   VARIABLE_NAME=VALUE`

  * `DATABASE_URL` - Connection string to the MySQL database - `mysql://localhost:3306/wp-bedrock` - Automatically added with the Scalingo MySQL addon
  * `WP_ENV` - Set to environment (`development`, `staging`, `production`)
  * `WP_HOME` - Full URL to WordPress home (http://my-wordpress.scalingo.io)
  * `WP_SITEURL` - Full URL to WordPress including subdirectory (http://my-wordpress.scalingo.io/wp)
  * `S3_UPLOADS_BUCKET` - Name of the S3 bucket to upload files to
  * `S3_UPLOADS_KEY` - AWS Access Key ID for S3 authentication
  * `S3_UPLOADS_SECRET` - AWS Secret Key for S3 authentication
  * `S3_UPLOADS_REGION` - Region of the S3 bucket
  * `AUTH_KEY`, `SECURE_AUTH_KEY`, `LOGGED_IN_KEY`, `NONCE_KEY`, `AUTH_SALT`, `SECURE_AUTH_SALT`, `LOGGED_IN_SALT`, `NONCE_SALT`

  You can get some random salts on the [Roots WordPress Salt Generator][roots-wp-salt].

3. Add theme(s) in `web/app/themes` as you would for a normal WordPress site.

4. Deploy the application on Scalingo

```
# Optionally add theme to your git repository
git add web/app/themes
git commit -m "Add themes"

# Then push to Scalingo
git push scalingo master
```

5. Access WP admin at `https://my-wordpress.scalingo.io/wp/wp-admin`

[roots-wp-salt]:https://roots.io/salts.html
