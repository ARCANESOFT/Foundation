<?php

namespace arcanesoft;

use Arcanesoft\Foundation\Arcanesoft;

if ( ! function_exists('arcanesoft\foundation')) {
    /**
     * Get the foundation's class instance.
     *
     * @return \Arcanesoft\Foundation\Arcanesoft
     */
    function foundation() {
        return app(Arcanesoft::class);
    }
}

require_once __DIR__.'/helpers/ui.php';
