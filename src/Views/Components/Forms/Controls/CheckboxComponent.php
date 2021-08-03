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
     * @param  string       $type
     * @param  string       $name
     * @param  string|null  $id
     * @param  string       $value
     * @param  string|null  $label
     * @param  bool         $checked
     */
    public function __construct(
        string $type = 'text',
        string $name,
        string $id = null,
        string $value = '',
        string $label = null,
        bool $checked = false
    )
    {
        parent::__construct($type, $name, $id, $value, $label);

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
