<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals;

use Illuminate\View\Component;

/**
 * Class     Body
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Body extends Component
{
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
        return view()->make('foundation::_components.modals.body');
    }
}
