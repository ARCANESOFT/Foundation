<?php

if ( ! function_exists('foundation')) {
    /**
     * Get the Foundation instance.
     *
     * @return \Arcanesoft\Foundation\Foundation
     */
    function foundation() {
        return app('arcanesoft.foundation');
    }
}
