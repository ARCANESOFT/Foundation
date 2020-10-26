<?php

namespace arcanesoft\ui;

use Arcanesoft\Foundation\Helpers\UI\Actions\{ButtonAction, LinkAction};

if ( ! function_exists('arcanesoft\ui\action_link')) {
    /**
     * Generate action link.
     *
     * @param  string  $name
     * @param  string  $url
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction
     */
    function action_link(string $name, string $url): LinkAction {
        return LinkAction::action($name, $url);
    }
}

if ( ! function_exists('arcanesoft\ui\action_link_icon')) {
    /**
     * Generate action link with icon only.
     *
     * @param  string  $name
     * @param  string  $url
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\LinkAction
     */
    function action_link_icon(string $name, string $url): LinkAction {
        return LinkAction::action($name, $url, false);
    }
}

if ( ! function_exists('arcanesoft\ui\action_button')) {
    /**
     * Generate action button.
     *
     * @param  string  $name
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction|mixed
     */
    function action_button(string $name): ButtonAction {
        return ButtonAction::action($name);
    }
}

if ( ! function_exists('arcanesoft\ui\action_button_icon')) {
    /**
     * Generate action button with icon only.
     *
     * @param  string  $name
     *
     * @return \Arcanesoft\Foundation\Helpers\UI\Actions\ButtonAction
     */
    function action_button_icon(string $name): ButtonAction {
        return ButtonAction::action($name, false);
    }
}
