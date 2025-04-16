<?php

return [
    [
        'model' => 'Car',
        'directory' => "Api",
        'columns' => [
            'name' => [
                'type' => 'string',
                'rules' => ['string', 'min:4', 'unique']
            ],
            'year' => [
                'type' => 'date',
                'rules' => ['date', 'after:today']
            ],
            'color' => [
                'type' => 'string',
                'rules' => ['string']
            ],
            'user_id' => [
                'type' => 'foreignId',
                'rules' => ['exists:users,id'],
            ]
        ],
    ],
    [
        'model' => 'Chat',
        'directory' => 'Special',
        'columns' => [
            'adable' => [
                'type' => 'string',
                'rules' => ['required', 'string']
            ],
            'key' => [
                'type' => 'string',
                'rules' => ['nullable']
            ],
            'name_ar' => [
                'type' => 'string',
                'rules' => ['required', 'min:3'],
            ],
            'name_en' => [
                'type' => 'string',
                'rules' => ['required', 'min:3'],
            ],
            'for_sell' => [
                'type' => 'boolean',
                'rules' => ['nullable', 'boolean'],
            ]

        ]
    ]

];
