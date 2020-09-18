<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\System\Views\Components;

use Arcanesoft\Foundation\Views\Component;
use Arcanesoft\Foundation\Views\Concerns\WithPagination;

/**
 * Class     Datatable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Datatable extends Component
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use WithPagination;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    public $perPageList = [
        25  => '25',
        50  => '50',
        75  => '75',
        100 => '100'
    ];

    public $perPage = 25;

    /* -----------------------------------------------------------------
     |  Other Methods
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
