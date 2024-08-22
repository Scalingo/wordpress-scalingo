<?php
/**
 * Configuratoin overrides for WP_ENV === 'production'
 */

use Roots\WPConfig\Config;
use function Env\env;

ini_set('display_errors', 0);

Config::define('WP_DEBUG_DISPLAY', false);
Config::define('SCRIPT_DEBUG', false);

/** Disable all file modifications including updates and update notifications */
Config::define('DISALLOW_FILE_MODS', true);

/** S3 Uploads Plugin */
Config::define('S3_UPLOADS_BUCKET', env('S3_UPLOADS_BUCKET'));
Config::define('S3_UPLOADS_KEY', env('S3_UPLOADS_KEY'));
Config::define('S3_UPLOADS_SECRET', env('S3_UPLOADS_SECRET'));
Config::define('S3_UPLOADS_REGION', env('S3_UPLOADS_REGION'));
Config::define('S3_UPLOADS_ENDPOINT', env('S3_UPLOADS_ENDPOINT'));
Config::define('S3_UPLOADS_OBJECT_ACL', env('S3_UPLOADS_OBJECT_ACL'));

if (env('S3_UPLOADS_BUCKET_URL')) {
    Config::define('S3_UPLOADS_BUCKET_URL', env('S3_UPLOADS_BUCKET_URL'));
} else {
    if (env('S3_UPLOADS_ENDPOINT') && env('S3_UPLOADS_BUCKET')) {
        $s3_uploads_endpoint = env('S3_UPLOADS_ENDPOINT');
        $s3_uploads_bucket = env('S3_UPLOADS_BUCKET');

        $parts = parse_url($s3_uploads_endpoint);
        $bucket_url = $parts['scheme'] . "://" . $s3_uploads_bucket . "." . $parts['host'];

        // Define the base bucket URL (without trailing slash)
        Config::define('S3_UPLOADS_BUCKET_URL', $bucket_url);
    }
}

if (env('S3_UPLOADS_HTTP_CACHE_CONTROL')) {
    Config::define('S3_UPLOADS_HTTP_CACHE_CONTROL', env('S3_UPLOADS_HTTP_CACHE_CONTROL'));
}

if (env('S3_UPLOADS_HTTP_EXPIRES')) {
    Config::define('S3_UPLOADS_HTTP_EXPIRES', env('S3_UPLOADS_HTTP_EXPIRES'));
}

if (env('S3_UPLOADS_AUTOENABLE')) {
    Config::define('S3_UPLOADS_AUTOENABLE', env('S3_UPLOADS_AUTOENABLE'));
}
