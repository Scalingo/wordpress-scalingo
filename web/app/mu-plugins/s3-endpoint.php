<?php
/*
Plugin Name:  S3 Uploads
Plugin URI:   chttps://github.com/humanmade/S3-Uploads#custom-endpoints
Description:  Configuration for custom S3 endpoint
*/

// Filter S3 Uploads params.
if (env('S3_UPLOADS_ENDPOINT')) {
    add_filter( 's3_uploads_s3_client_params', function ( $params ) {
        $params['endpoint'] = env('S3_UPLOADS_ENDPOINT');
        $params['use_path_style_endpoint'] = false; // set to true if URL path should be https://host/<bucket>/...
        $params['debug'] = true; // Set to true if uploads are failing.
        return $params;
    });
}
