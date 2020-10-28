<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Illuminate\View\Component;

/**
 * Class     Select
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Select extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  iterable */
    public $options;

    /** @var  string */
    public $name;

    /** @var  string|null */
    public $id;

    /** @var  mixed|null */
    public $value;

    /** @var  string|null */
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Select constructor.
     *
     * @param  iterable     $options
     * @param  string       $name
     * @param  string|null  $id
     * @param  mixed|null   $value
     * @param  string|null  $label
     */
    public function __construct(
        iterable $options,
        string $name,
        string $id = null,
        $value = null,
        ?string $label = null
    ){

        $this->options = $options;
        $this->name    = $name;
        $this->id      = $id;
        $this->value   = $value;
        $this->label   = $label;
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
        return view()->make('foundation::_components.forms.controls.select');
    }
}
