<?php

if ( ! function_exists('foundation')) {
    /**
     * Get the Foundation instance.
     *
     * @return \Arcanesoft\Foundation\Contracts\Foundation
     */
    function foundation() {
        return app(Arcanesoft\Foundation\Contracts\Foundation::class);
    }
}
