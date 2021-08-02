<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Inputs;

use Illuminate\Contracts\View\View;

/**
 * Class     PasswordComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PasswordComponent extends Component
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
        return $this->view('forms.inputs.password');
    }
}
