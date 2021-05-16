<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Pagination;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

/**
 * Class     Pages
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Pages extends Component
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
     * Pages constructor.
     *
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
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view()->make('foundation::_components.pagination.pages');
    }
}
