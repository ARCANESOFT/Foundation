<?php

return [

    'commands' => [
        'install' => [
            Arcanesoft\Foundation\Core\Console\InstallCommand::class,
            Arcanesoft\Foundation\Authorization\Console\InstallCommand::class,
            Arcanesoft\Foundation\Cms\Console\InstallCommand::class,
            Arcanesoft\Foundation\System\Console\InstallCommand::class,
        ],
    ],

];
