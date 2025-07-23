<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
        'cv' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/cv'),
            'url' => env('APP_URL').'/storage/uploads/cv',
            'visibility' => 'public',
        ],
    
        'motivation' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/motivation'),
            'url' => env('APP_URL').'/storage/uploads/motivation',
            'visibility' => 'public',
        ],
    
        'passport' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/passport'),
            'url' => env('APP_URL').'/storage/uploads/passport',
            'visibility' => 'public',
        ],
    
        'transcript' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/transcript'),
            'url' => env('APP_URL').'/storage/uploads/transcript',
            'visibility' => 'public',
        ],
        'loa' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/loa'),
            'url' => env('APP_URL').'/storage/uploads/loa',
            'visibility' => 'public',
        ],
        'cover' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/FileManagement/cover'),
            'url' => env('APP_URL').'/storage/uploads/FileManagement/cover',
            'visibility' => 'public',
        ],
        'full_announcement' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/FileManagement/full_announcement'),
            'url' => env('APP_URL').'/storage/uploads/FileManagement/full_announcement',
            'visibility' => 'public',
        ],
        'final_announcement' => [
            'driver' => 'local',
            'root' => storage_path('app/public/uploads/FileManagement/final_announcement'),
            'url' => env('APP_URL').'/storage/uploads/FileManagement/final_announcement',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],
       
     

    ],
    
    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
