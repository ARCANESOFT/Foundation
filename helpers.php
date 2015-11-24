<?php

if ( ! function_exists('foundation')) {
    /**
     * Get Foundation instance.
     *
     * @return \Arcanesoft\Foundation\Foundation
     */
    function foundation() {
        return app('arcanesoft.foundation');
    }
}
