<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Cms;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     LocalizedContentComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class LocalizedContentComponent extends Component
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
        return $this->view('cms.localized-content');
    }
}
