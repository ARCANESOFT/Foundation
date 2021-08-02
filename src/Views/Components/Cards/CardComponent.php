<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Cards;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     CardComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CardComponent extends Component
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
        return $this->view('cards.card');
    }
}
