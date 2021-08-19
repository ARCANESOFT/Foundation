<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components;

use Illuminate\Contracts\View\View;

/**
 * Class     LayoutComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LayoutComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritdoc}
     */
    public function render(): View
    {
        return $this->view('layout');
    }
}
