<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals\Buttons;

use Illuminate\View\Component;

/**
 * Class     Cancel
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Cancel extends Component
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
        return view()->make('foundation::_components.modals.buttons.cancel');
    }
}
