<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Illuminate\View\Component;

/**
 * Class     Textarea
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Textarea extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string
     */
    public $name;

    /**
     * @var string|null
     */
    public $id;

    /**
     * @var string|null
     */
    public $value;

    /**
     * @var string|null
     */
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Textarea constructor.
     *
     * @param  string       $name
     * @param  string|null  $id
     * @param  string|null  $value
     * @param  string|null  $label
     */
    public function __construct(string $name, ?string $id = null, ?string $value = '', ?string $label = null)
    {
        $this->name  = $name;
        $this->id    = $id;
        $this->value = $value;
        $this->label = $label;
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
        return view()->make('foundation::_components.forms.controls.textarea');
    }
}
