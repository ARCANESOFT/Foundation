<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Buttons;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     CloseComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CloseComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritDoc}
     */
    public function render(): View
    {
        return $this->view('buttons.close');
    }
}
