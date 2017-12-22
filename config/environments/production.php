<?php
/** Production */
ini_set('display_errors', 0);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', false);
/** Disable all file modifications including updates and update notifications */
define('DISALLOW_FILE_MODS', true);

define('S3_UPLOADS_BUCKET', env('S3_UPLOADS_BUCKET'));
define('S3_UPLOADS_KEY', env('S3_UPLOADS_KEY'));
define('S3_UPLOADS_SECRET', env('S3_UPLOADS_SECRET'));
define('S3_UPLOADS_REGION', env('S3_UPLOADS_REGION'));

if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    $_SERVER['HTTPS'] = 'on';
