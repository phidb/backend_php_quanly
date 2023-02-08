<?php

return [
    'url'               => [
        'prefix_admin'  => 'admin123',
        'prefix_news'   => 'news',
    ],
    'format'            => [
        'long_time'     => 'H:m:s d/m/Y',
        'short_time'    => 'd/m/Y'
    ],
    'template'          => [
        'status'        => [
            'all'       => ['name'=> 'Tất cả',          'class'=>'btn-success'],
            'active'    => ['name'=> 'Kích hoạt',       'class'=>'btn-success'],
            'inactive'  => ['name'=> 'Chưa Kích Hoạt',  'class'=>'btn-info'],
            'block'     => ['name'=> 'Bị khóa',         'class'=>'btn-danger'],
            'default'   => ['name'=> 'Chưa xác định',   'class'=>'btn-info'],
        ]
    ]
];