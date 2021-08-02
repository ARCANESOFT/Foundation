<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals\Buttons;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     CancelComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CancelComponent extends Component
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
        return $this->view('modals.buttons.cancel');
    }
}
