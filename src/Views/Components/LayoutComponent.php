<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components;

use Arcanesoft\Foundation\Helpers\Sidebar\Manager;
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
        $this->withAttributes([
            'data-skin-mode'       => session()->get('foundation.skin.mode', 'light'),
            'data-sidebar-visible' => Manager::isVisible() ? 'true' : 'false',
        ]);

        return $this->view('layout');
    }
}
