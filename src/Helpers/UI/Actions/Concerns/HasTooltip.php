<?php namespace Arcanesoft\Foundation\Helpers\UI\Actions\Concerns;

/**
 * Trait     HasTooltip
 *
 * @package  Arcanesoft\Foundation\Helpers\UI\Actions\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
trait HasTooltip
{
    /**
     * Set the tooltip.
     *
     * @param  string  $title
     * @param  string  $placement
     *
     * @return $this
     */
    public function tooltip(string $title, string $placement = 'top')
    {
        return $this->attributes([
            'data-toggle'    => 'tooltip',
            'data-placement' => $placement,
            'title'          => $title,
        ]);
    }
}
