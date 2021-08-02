<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     HeaderComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class HeaderComponent extends Component
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
        return $this->view('modals.header');
    }
}
