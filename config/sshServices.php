<?php

return [
    
    'mysql_type' => env('MYSQL_TYPE', 'mariadb'),
    
    'services' => [
        
        'scandaemon' => [
            'public_name' => 'CSI Scanning',
            'description' => 'Daemon Uptime',
            'flaticon_name' => 'flaticon-reload-lite',
            'css_class' => 'btn-outline-danger',
        ],

        'sgdaemon' => [
            'public_name' => 'CSI Smart Group',
            'description' => 'Generation Daemon Uptime',
            'flaticon_name' => 'flaticon-user-group',
            'css_class' => 'btn-outline-secondary',
        ],

        'mariadb' => [
            'public_name' => 'MariaDB Database',
            'description' => 'Server Uptime',
            'flaticon_name' => 'fas fa-server',
            'css_class' => 'btn-outline-success',
        ],

        'httpd' => [
            'public_name' => 'Apache HTTP',
            'description' => 'Server Uptime',
            'flaticon_name' => 'fas fa-window-maximize',
            'css_class' => 'btn-outline-warning',
        ],

        'mysql' => [
            'public_name' => 'MySQL Database',
            'description' => 'Server Uptime',
            'flaticon_name' => 'fas fa-server',
            'css_class' => 'btn-outline-success',
        ],
        
    ],
    
];