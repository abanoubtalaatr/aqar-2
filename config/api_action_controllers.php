<?php

return [
    [
        'name' => 'PublishAbanoub',
        'directory' => 'Api',
        'method' => 'post',
        'route_name' => '/abanoub-publish',
        'validation' => [
            'published_at' => ['required' ,'date']
        ]
    ],
];
