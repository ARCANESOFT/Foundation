<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Illuminate\View\Component;

/**
 * Class     Vue
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Vue extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * @var string
     */
    public $component;

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
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    public function __construct(string $component, string $name, ?string $id, ?string $label)
    {
        $this->component = $component;
        $this->name      = $name;
        $this->id        = $id;
        $this->label     = $label;
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
        return view()->make('foundation::_components.forms.controls.vue');
    }
}
