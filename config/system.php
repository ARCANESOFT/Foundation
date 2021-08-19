<?php

return [

    /* -----------------------------------------------------------------
     |  Checks
     | -----------------------------------------------------------------
     */

    'checks' => [
        'folders' => [
            'bootstrap/',
            'bootstrap/cache/',
            'storage/app/',
            'storage/framework/',
            'storage/logs/',
        ],

        'php-extensions' => [
            'bcmath',
            'ctype',
            'cURL',
            'JSON',
            'mbstring',
            'openssl',
            'pdo',
            'tokenizer',
            'xml',
        ],
    ],

];
