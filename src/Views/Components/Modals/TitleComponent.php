<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     TitleComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TitleComponent extends Component
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
        return $this->view('modals.title');
    }
}
