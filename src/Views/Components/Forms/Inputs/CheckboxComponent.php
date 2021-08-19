<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Inputs;

use Illuminate\Contracts\View\View;

/**
 * Class     CheckboxComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class CheckboxComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  bool */
    public $checked;

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
        string $type = 'checkbox',
        string $name,
        string $id = null,
        $value = null,
        bool $checked = false
    ) {
        parent::__construct($type, $name, $id, $value);

        $this->checked = $checked;
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
        return $this->view('forms.inputs.checkbox');
    }
}
