<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components;

use Arcanesoft\Foundation\Helpers\Sidebar\Manager;
use Illuminate\View\Component;

/**
 * Class     Layout
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Layout extends Component
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /** @{@inheritdoc} */
    public function render()
    {
        $this->withAttributes([
            'data-skin-mode'       => session()->get('foundation.skin.mode', 'light'),
            'data-sidebar-visible' => Manager::isVisible() ? 'true' : 'false',
        ]);

        return view()->make('foundation::_components.layout');
    }
}
