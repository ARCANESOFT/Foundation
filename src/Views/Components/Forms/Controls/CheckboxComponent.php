<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

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
     * @param  string       $name
     * @param  string|null  $id
     * @param  string       $type
     * @param  string       $value
     * @param  string|null  $label
     * @param  bool         $checked
     */
    public function __construct(
        string $name,
        string $id = null,
        string $type = 'text',
        string $value = '',
        string $label = null,
        bool $checked = false
    )
    {
        parent::__construct($name, $id, $type, $value, $label);

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
        return $this->view('forms.controls.checkbox');
    }
}
