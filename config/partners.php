<?php

return [
    'partners' => array(
        'zee5' => [
            'iss' => 'http://thenewj.com',
            'secret' => env('ZEE5SECRET', ''),
            'sub' => 'ZEE5',
            'aud' => 'partner',
            'exp' => 60*60,
        ]
    ),
];
