<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Arcanesoft\Foundation\Views\Components\Forms\ControlComponent;

/**
 * Class     Checkbox
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Checkbox extends ControlComponent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var bool */
    public $checked;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Checkbox constructor.
     *
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
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view()->make('foundation::_components.forms.controls.checkbox');
    }
}
