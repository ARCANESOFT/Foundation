<?php declare(strict_types=1);

namespace Arcanesoft\Foundation\Views\Components\Table;

use Arcanesoft\Foundation\Views\Components\Component;
use Illuminate\Contracts\View\View;

/**
 * Class     ThComponent
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class ThComponent extends Component
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  string|null */
    public $label = null;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * @param  string|null  $label
     */
    public function __construct(string $label = null)
    {
        if ( ! empty($label))
            $this->label = __($label);
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
        return $this->view('table.table-th');
    }
}
