<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Illuminate\View\Component;

/**
 * Class     Form
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class Form extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var string */
    public $action;

    /** @var string */
    public $method;

    /** @var bool */
    public $hasFiles;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Form constructor.
     *
     * @param  string  $action
     * @param  string  $method
     * @param  bool    $hasFiles
     */
    public function __construct(string $action, string $method = 'POST', bool $hasFiles = false)
    {
        $this->action   = $action;
        $this->method   = strtoupper($method);
        $this->hasFiles = $hasFiles;
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
        return view('foundation::_components.forms.form');
    }
}
