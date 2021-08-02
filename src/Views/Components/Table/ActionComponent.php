<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Table;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

/**
 * Class     ActionComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ActionComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string */
    public $type;

    /** @var  string */
    public $action;

    /** @var  string */
    public $label;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string  $type
     * @param  string  $action
     */
    public function __construct(string $type, string $action, ?string $label = null)
    {
        $this->type = Str::slug($type);
        $this->action = $action;
        $this->label = $label ?: Str::ucfirst($type);
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
        return $this->view('table.table-action');
    }
}
