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
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string       $type
     * @param  string       $name
     * @param  string|null  $id
     * @param  mixed|null   $value
     */
    public function __construct(
        string $type = 'password',
        string $name = 'password',
        string $id = null,
        $value = null
    ) {
        $value = null;

        parent::__construct($type, $name, $id, $value);
    }

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
