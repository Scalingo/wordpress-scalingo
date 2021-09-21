<?php
/** Production */
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', true);

define('S3_UPLOADS_BUCKET', getenv('S3_UPLOADS_BUCKET'));
define('S3_UPLOADS_KEY', getenv('S3_UPLOADS_KEY'));
define('S3_UPLOADS_SECRET', getenv('S3_UPLOADS_SECRET'));
define('S3_UPLOADS_REGION', getenv('S3_UPLOADS_REGION'));
define('S3_UPLOADS_ENDPOINT', getenv('S3_UPLOADS_ENDPOINT'));
if (getenv('S3_UPLOADS_ENDPOINT') && getenv('S3_UPLOADS_BUCKET') && !getenv('S3_UPLOADS_BUCKET_URL')) {
    $s3_uploads_endpoint = getenv('S3_UPLOADS_ENDPOINT');
    $s3_uploads_bucket = getenv('S3_UPLOADS_BUCKET');
    $parts = parse_url($s3_uploads_endpoint);
    $bucket_url = $parts['scheme'] . "://" . $s3_uploads_bucket . "." . $parts['host'];

    // Define the base bucket URL (without trailing slash)
    define('S3_UPLOADS_BUCKET_URL', $bucket_url);
} else {
    define('S3_UPLOADS_BUCKET_URL', getenv('S3_UPLOADS_BUCKET_URL'));
}

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    $_SERVER['HTTPS'] = 'on';
