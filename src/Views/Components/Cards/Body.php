<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Cards;

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
        return view('foundation::_components.cards.body');
    }
}