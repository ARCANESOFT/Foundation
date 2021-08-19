<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Modals;

use Arcanesoft\Foundation\Views\Components\Component;

/**
 * Class     ModalComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ModalComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return $this->view('modals.modal');
    }
}
