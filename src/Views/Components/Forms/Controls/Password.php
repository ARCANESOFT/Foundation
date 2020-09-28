<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms\Controls;

use Arcanesoft\Foundation\Views\Components\Forms\ControlComponent;

/**
 * Class     Password
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Password extends ControlComponent
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  bool */
    public $grouped;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Password constructor.
     *
     * @param  string       $name
     * @param  string|null  $id
     * @param  string       $type
     * @param  string       $value
     * @param  string|null  $label
     * @param  bool         $grouped
     */
    public function __construct(
        string $name,
        string $id = null,
        string $type = 'text',
        string $value = '',
        string $label = null,
        bool $grouped = false
    ) {
        parent::__construct($name, $id, $type, $value, $label);

        $this->grouped = $grouped;
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
        return view('foundation::_components.forms.controls.password');
    }
}
