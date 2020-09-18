<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Views\Components;

use Arcanesoft\Foundation\Views\Component;
use Arcanesoft\Foundation\Views\Concerns\{WithPagination, WithSortField};

/**
 * Class     DatatableComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class DatatableComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use WithPagination,
        WithSortField;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $perPage = 25;

    public $perPageList = [
        25  => '25',
        50  => '50',
        75  => '75',
        100 => '100'
    ];

    public $search = '';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * When updating the `search` property.
     */
    protected function updatingSearch(): void
    {
        $this->resetPaginationPage();
    }
}
