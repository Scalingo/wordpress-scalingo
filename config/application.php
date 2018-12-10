<?php

/** @var string Directory containing all of the site's files */
$root_dir = dirname(__DIR__);

/** @var string Document Root */
$webroot_dir = $root_dir . '/web';

/**
 * Expose global env() function from oscarotero/env
 */
Env::init();

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
$dotenv = new Dotenv\Dotenv($root_dir);
if (file_exists($root_dir . '/.env')) {
    $dotenv->load();
    $dotenv->required(['DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL']);
}

/**
 * Set up our global environment constant and load its config first
 * Default: production
 */
define('WP_ENV', env('WP_ENV') ?: 'production');

$env_config = __DIR__ . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
    require_once $env_config;
}

/**
 * URLs
 */
define('WP_HOME', env('WP_HOME'));
define('WP_SITEURL', env('WP_SITEURL'));

/**
 * Custom Content Directory
 */
define('CONTENT_DIR', '/app');
define('WP_CONTENT_DIR', $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL', WP_HOME . CONTENT_DIR);

/**
 * DB settings
 */
$mysql_url = parse_url(env('DATABASE_URL') ?: 'mysql://localhost:3306/wp-bedrock');
$db = substr($mysql_url['path'], 1);

define('DB_NAME', $db);
define('DB_USER', $mysql_url['user']);
define('DB_PASSWORD', $mysql_url['pass']);
define('DB_HOST', $mysql_url['host'] . ":" . $mysql_url['port']);
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', '');
$table_prefix = env('DB_PREFIX') ?: 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
define('AUTH_KEY', env('AUTH_KEY'));
define('SECURE_AUTH_KEY', env('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', env('LOGGED_IN_KEY'));
define('NONCE_KEY', env('NONCE_KEY'));
define('AUTH_SALT', env('AUTH_SALT'));
define('SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT', env('LOGGED_IN_SALT'));
define('NONCE_SALT', env('NONCE_SALT'));

/**
 * Custom Settings
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISABLE_WP_CRON', env('DISABLE_WP_CRON') ?: false);
define('DISALLOW_FILE_EDIT', true);

/**
 * S3 Uploads Plugin
 */
define('S3_UPLOADS_BUCKET', getenv('S3_UPLOADS_BUCKET') );
define('S3_UPLOADS_KEY', getenv('S3_UPLOADS_KEY') );
define('S3_UPLOADS_SECRET', getenv('S3_UPLOADS_SECRET') );
define('S3_UPLOADS_REGION', getenv('S3_UPLOADS_REGION') );
define('S3_UPLOADS_HTTP_CACHE_CONTROL', getenv('S3_UPLOADS_HTTP_CACHE_CONTROL') );
define('S3_UPLOADS_HTTP_EXPIRES', getenv('S3_UPLOADS_HTTP_EXPIRES') );
define('S3_UPLOADS_BUCKET_URL', getenv('S3_UPLOADS_BUCKET_URL') );

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
    define('ABSPATH', $webroot_dir . '/wp/');
}
