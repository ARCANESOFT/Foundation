<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Concerns;

use Arcanedev\Html\Elements\A;

/**
 * Trait     WithSortField
 *
 * @package  Arcanesoft\Foundation\Views\Concerns
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @property  string  sortField
 */
trait WithSortField
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $sortAsc = true;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Sort by the given filed.
     *
     * @param  string  $field
     */
    public function sortBy(string $field): void
    {
        $this->sortAsc   = $this->sortField === $field ? (! $this->sortAsc) : true;
        $this->sortField = $field;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the sort direction.
     *
     * @return string
     */
    protected function getSortDirection(): string
    {
        return $this->sortAsc ? 'asc' : 'desc';
    }

    /**
     * Render sort field.
     *
     * @param  string       $field
     * @param  string|null  $label
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function renderSortField(string $field, string $label = null)
    {
        $class = 'btn-sorting';

        if ($this->sortField === $field) {
            $class .= $this->sortAsc ? ' btn-sorting-asc' : ' btn-sorting-desc';
        }

        return A::make()
            ->href('#')
            ->attributes([
                'arc:click.prevent' => "sortBy('{$field}')",
                'class'             => $class,
                'role'              => 'button',
            ])
            ->html(__($label ?: $field))
            ->render();
    }
}
