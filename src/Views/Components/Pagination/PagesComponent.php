<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Pagination;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;

/**
 * Class     PagesComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PagesComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Illuminate\Contracts\Pagination\LengthAwarePaginator */
    public $paginator;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  \Illuminate\Contracts\Pagination\LengthAwarePaginator  $paginator
     */
    public function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return $this->view('pagination.pages');
    }
}
