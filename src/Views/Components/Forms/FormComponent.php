<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Forms;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     FormComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FormComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $action;

    /** @var  string */
    public $method;

    /** @var  bool */
    public $hasFiles;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
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
     * {@inheritDoc}
     */
    public function render(): View
    {
        return $this->view('forms.form');
    }
}
