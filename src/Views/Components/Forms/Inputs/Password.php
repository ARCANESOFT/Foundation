<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Inputs;

use Arcanesoft\Foundation\Views\Components\Forms\InputComponent;

/**
 * Class     Password
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Password extends InputComponent
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('foundation::_components.forms.inputs.password');
    }
}
