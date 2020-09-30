<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Buttons;

use Illuminate\View\Component;

/**
 * Class     Close
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Close extends Component
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('foundation::_components.buttons.close');
    }
}
