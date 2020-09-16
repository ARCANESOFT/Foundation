<?php

namespace arcanesoft\ui;

use Arcanedev\Html\Elements\Span;
use Arcanesoft\Foundation\Helpers\UI\Actions\{ButtonAction, LinkAction};
use Closure;

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

if ( ! function_exists('arcanesoft\ui\count_pill')) {
    /**
     * Generate count pill.
     *
     * @param  int|float      $count
     * @param  \Closure|null  $condition
     *
     * @return \Arcanedev\Html\Elements\Span
     */
    function count_pill($count, Closure $condition = null)
    {
        if (is_null($condition)) {
            $condition = function ($count) {
                return $count > 0 ? 'rounded-pill border border-info' : '';
            };
        }

        return Span::make()
            ->class(['badge', 'text-muted', $condition($count)])
            ->text($count);
    }
}
